<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Mount\DietBundle\Entity\Day;

class DaysController extends Controller
{
    /**
     * indexAction
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        echo 'done';
    }

    /**
     * getAction
     *
     * @param Request $request
     * @access public
     * @return void
     */
    public function getAction(Request $request)
    {
        $date = \DateTime::createFromFormat(Day::URL_DATE_FORMAT, $request->get('date'));

        if (!$date) {
            throw new \InvalidArgumentException('Invalid date');
        }

        $day = $this->getDoctrine()->getRepository('MountDietBundle:Day')->findOneByDate($date);

// TODO refactor to use date from GET
        $day = new Day();
        $day->setDate($date);

        $mealRepository = $this->getDoctrine()->getRepository('MountDietBundle:Meal');

        return $this->render(
            'MountDietBundle:Days:get.html.twig',
            array(
                'day' => $day,
                'breakfast' => $mealRepository->findBreakfast(),
                'dinner' => $mealRepository->findDinner(),
                'tea' => $mealRepository->findTea(),
                'supper' => $mealRepository->findSupper(),
            )
        );
    }

    public function postAction(Request $request)
    {
        $date = $request->get('date');

        $day = new Day();
        $day->setDateFromString($date);

        $mealRepository = $this->getDoctrine()->getRepository('MountDietBundle:Meal');

        $breakfast = $mealRepository->find($request->get('breakfast'));
        $day->setBreakfast($breakfast);

        $secondBreakfast = $mealRepository->find($request->get('second_breakfast'));
        $day->setSecondBreakfast($secondBreakfast);

        $dinner = $mealRepository->find($request->get('dinner'));
        $day->setDinner($dinner);

        $tea = $mealRepository->find($request->get('tea'));
        $day->setTea($tea);

        $supper = $mealRepository->find($request->get('supper'));
        $day->setSupper($supper);

        $day->calculateNutrition();

        $em = $this->getDoctrine()->getManager();
        $em->persist($day);
        $em->flush();

        $this->get('session')->setFlash('notice', 'Zapisano dzień.');

        // Redirect - This is important to prevent users re-posting the form if they refresh the page
        return $this->redirect($this->generateUrl('mount_diet_days'), 201);
    }
}
