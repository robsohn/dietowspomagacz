<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Mount\DietBundle\Entity\Day;

class DaysController extends Controller
{
    public function indexAction()
    {
        throw new \RuntimeException('Action not working');
    }

    public function getAction(Request $request)
    {
        $date = $request->get('date');

        //$day = $this->getDoctrine()->getRepository('MountDietBundle:Day')->findByDate($date);
        $day = new Day();
        $day->setDate('2013-09-20');

        return $this->render(
            'MountDietBundle:Days:get.html.twig',
            array(
                'day' => $day,
            )
        );
    }
}
