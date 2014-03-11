<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Mount\DietBundle\Form\FoodType;

class FoodController extends Controller
{
    /**
     * Lists all food
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $food = $this->getDoctrine()->getRepository('MountDietBundle:Food\Food')->findAll();
        $form = $this->generateForm();

        return $this->render(
            'MountDietBundle:Food:index.html.twig',
            array(
                'form' => $form->createView(),
                'food' => $food,
            )
        );
    }

    /**
     * Saves food
     * @param  Request $request
     * @return void
     */
    public function postAction(Request $request)
    {
        $form = $this->generateForm();
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Jedzenie zostało dodane.');
        }

        // Redirect - This is important to prevent users re-posting the form if they refresh the page
        return $this->redirect($this->generateUrl('mount_diet_food'), 201);
    }

    protected function generateForm()
    {
        return $this->createForm(new FoodType());
    }
}
