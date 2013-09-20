<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MountDietBundle:Default:index.html.twig');
    }
}
