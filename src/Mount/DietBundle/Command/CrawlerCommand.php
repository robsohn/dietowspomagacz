<?php

namespace Mount\DietBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\DomCrawler\Crawler;

use Guzzle\Http\Client;

use Mount\DietBundle\Entity\Food;
use Mount\DietBundle\Entity\FoodCategory;

class CrawlerCommand extends ContainerAwareCommand
{
    protected $foodCategories = null;

    protected function configure()
    {
        $this
            ->setName('mount:crawl')
            ->setDescription('Crawl Tabela Kalorii')
            ->addArgument(
                'csvFile',
                InputArgument::REQUIRED,
                'Plike CSV z jedzeniem'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client('http://www.tabele-kalorii.pl');
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $servingSize = $this->getContainer()->get('doctrine')
                ->getRepository('MountDietBundle:ServingSize')->find(1);

        if (($handle = fopen($input->getArgument('csvFile'), 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $food = new Food();
                $food->setName($data[0]);
                $food->setCategory($this->categoryLookUp($data[1]));
                $food->setServingSize($servingSize);

                $request = $client->get($data[2]);
                $response = $request->send();
                $crawler = new Crawler($response->getBody(true));
                $rows = $crawler->filter('div#modul-kalorie table[class="tabela-z-odstepami"] tr');

                foreach ($rows as $row) {
                    if (strpos($row->firstChild->nodeValue, 'energetyczna') !== false) {
                        $calories = str_replace('kcal', '', $row->lastChild->nodeValue);
                        $calories = trim(str_replace(',', '.', $calories));
                        $food->setCalories($calories);
                    } elseif (strpos($row->firstChild->nodeValue, 'Bia') !== false) {
                        $protein = $row->lastChild->nodeValue;
                        $protein = str_replace('g', '', $protein);
                        $protein = trim(str_replace(',', '.', $protein));
                        $food->setProtein($protein);
                    } elseif (strpos($row->firstChild->nodeValue, 'glowodany') !== false) {
                        $carbs = $row->lastChild->nodeValue;
                        $carbs = str_replace('g', '', $carbs);
                        $carbs = trim(str_replace(',', '.', $carbs));
                        $food->setCarbs($carbs);
                    } elseif (strpos($row->firstChild->nodeValue, 'uszcz') !== false) {
                        $fat = $row->lastChild->nodeValue;
                        $fat = str_replace('g', '', $fat);
                        $fat = trim(str_replace(',', '.', $fat));
                        $food->setFat($fat);
                    }
                }

                $em->persist($food);
                $output->writeln('Zapisano jedzenie: ' . $food->getName());
            }
            fclose($handle);

            $em->flush();
        }
    }

    private function categoryLookUp($name)
    {
        if (is_null($this->foodCategories)) {
            $foodCategories = $this->getContainer()->get('doctrine')
                ->getRepository('MountDietBundle:FoodCategory')->findAll();

            foreach ($foodCategories as $category) {
                $this->foodCategories[$category->getName()] = $category;
            }
        }

        return $this->foodCategories[$name];
    }
}
