<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Mount\DietBundle\Form\MealType;

use Mount\DietBundle\Entity\Meal\Food as MealFood;

/**
 * MealsController
 *
 * @uses \Symfony\Bundle\FrameworkBundle\Controller\Controller
 * @package MountDietBundle
 */
class MealsController extends Controller
{
    /**
     * indexAction
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $meals = $this->getDoctrine()->getRepository('MountDietBundle:Meal\Meal')->findAll();

        return $this->render(
            'MountDietBundle:Meals:index.html.twig',
            array(
                'meals' => $meals,
            )
        );
    }

    /**
     * Saves meal
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postAction(Request $request)
    {
        $form = $this->generateForm();
        $form->bind($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $foodRepository = $em->getRepository('MountDietBundle:Food\Food');

            $meal = $form->getData();

            foreach ($request->get('food') as $foodId => $data) {
                if (! isset($data['selected']) || $data['selected'] != 1) {
                    continue;
                }

                $food = $foodRepository->find($foodId);
// TODO Add error reporting if food not found

                $mealFood = new MealFood();
                $mealFood->setFood($food);
                $mealFood->setMeal($meal);
                $mealFood->setServing($data['serving']);
                $mealFood->calculateNutrition();

                $meal->addFood($mealFood);
            }

            $meal->calculateNutrition();

            $em->persist($meal);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Jedzenie zostało dodane.');
        }

        // Redirect - This is important to prevent users re-posting the form if they refresh the page
        return $this->redirect($this->generateUrl('mount_diet_meals'), 201);
    }

    /**
     * newAction
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $food = $this->getDoctrine()->getRepository('MountDietBundle:Food\Food')->findAll();
        $form = $this->generateForm();

        return $this->render(
            'MountDietBundle:Meals:new.html.twig',
            array(
                'form' => $form->createView(),
                'food' => $food,
            )
        );
    }

    /**
     * generateForm
     *
     * @return Mount\DietBundle\Form\MealType
     */
    protected function generateForm()
    {
        return $this->createForm(new MealType());
    }
}
