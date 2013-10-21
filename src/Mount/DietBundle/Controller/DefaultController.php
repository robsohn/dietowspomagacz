<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mount\DietBundle\Entity\Day\Day;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $date = new \DateTime('now');
        $day = $this->getDoctrine()->getRepository('MountDietBundle:Day\Day')->findOneByDate($date);

        if (!$day) {
            $day = new Day();
            $day->setDate($date);
        }

        return $this->render(
            'MountDietBundle:Default:index.html.twig',
            array(
                'day' => $day
            )
        );
    }
}
