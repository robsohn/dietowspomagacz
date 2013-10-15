<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $day = $this->getDoctrine()->getRepository('MountDietBundle:Day')->findOneByDate(new \DateTime('now'));

        return $this->render(
            'MountDietBundle:Default:index.html.twig',
            array(
                'day' => $day
            )
        );
    }
}
