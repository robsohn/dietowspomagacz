<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Mount\DietBundle\Form\MealType;

use Mount\DietBundle\Entity\Meal\Food;

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
     * @return
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

    public function postAction(Request $request)
    {
        $form = $this->generateForm();
        $form->bind($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $foodRepository = $em->getRepository('MountDietBundle:Food\Food');

            $meal = $form->getData();

            $calories = 0;
            $fat = 0;
            $carbs = 0;
            $protein = 0;

            foreach ($request->get('food') as $foodId => $data) {
                if (! isset($data['selected']) || $data['selected'] != 1) {
                    continue;
                }
// TODO refactor: calculating nutrition should be part of Meal class
                $food = $foodRepository->find($foodId);
                $multiplier = $food->getServingSize()->getMultiplier();

                $mealFood = new MealFood();
                $mealFood->setFood($food);
                $mealFood->setMeal($meal);

                $mealFood->setServing($data['serving']);

                $mealFoodCalories = ($food->getCalories()*$data['serving']) / $multiplier;
                $calories += $mealFoodCalories;
                $mealFood->setCalories($mealFoodCalories);

                $mealFoodCarbs = ($food->getCarbs()*$data['serving']) / $multiplier;
                $carbs += $mealFoodCarbs;
                $mealFood->setCarbs($mealFoodCarbs);

                $mealFoodFat = ($food->getFat()*$data['serving']) / $multiplier;
                $fat += $mealFoodFat;
                $mealFood->setFat($mealFoodFat);

                $mealFoodProtein = ($food->getProtein()*$data['serving']) / $multiplier;
                $protein += $mealFoodProtein;
                $mealFood->setProtein($mealFoodProtein);

                $meal->addFood($mealFood);
            }

            $meal->setCalories($calories);
            $meal->setFat($fat);
            $meal->setCarbs($carbs);
            $meal->setProtein($protein);

            $em->persist($meal);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Jedzenie zostało dodane.');
        }

        // Redirect - This is important to prevent users re-posting the form if they refresh the page
        return $this->redirect($this->generateUrl('mount_diet_meals'), 201);
    }

    /**
     * newAction
     *
     * @return
     */
    public function newAction()
    {
        $food = $this->getDoctrine()->getRepository('MountDietBundle:Food')->findAll();
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
