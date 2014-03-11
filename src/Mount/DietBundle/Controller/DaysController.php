<?php

namespace Mount\DietBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Mount\DietBundle\Entity\Day\Day;

class DaysController extends Controller
{
    /**
     * indexAction
     *
     * @access public
     * @return void
     *
     * @todo  Implement calendar viewing
     */
    public function indexAction()
    {
        $response = $this->forward('MountDietBundle:Days:get');

        // ... further modify the response or return it directly

        return $response;
    }

    /**
     * getAction
     *
     * @param Request $request
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request)
    {
        $date = \DateTime::createFromFormat(Day::URL_DATE_FORMAT, $request->get('date'));

        if (!$date) {
            throw new \InvalidArgumentException('Invalid date');
        }

        $day = $this->getDoctrine()->getRepository('MountDietBundle:Day\Day')->findOneByDate($date);

        if (is_null($day)) {
            $day = new Day();
            $day->setDate($date);
        }

        return $this->render(
            'MountDietBundle:Days:get.html.twig',
            array(
                'day' => $day,
                'meals' => $this->getDoctrine()->getRepository('MountDietBundle:Meal\Meal')->findAllSortedByName(),
            )
        );
    }

    public function postAction(Request $request)
    {
        $date = $request->get('date');

        $day = new Day();
        $day->setDateFromString($date);

        $mealRepository = $this->getDoctrine()->getRepository('MountDietBundle:Meal\Meal');
error_log(print_r($request,1));

        $breakfast = $request->get('breakfast');
        if (count($breakfast) > 0) {
            $mealType = $this->getDoctrine()->getRepository('MountDietBundle:Meal\Type')->findBreakfast();
            foreach ($breakfast as $meal) {
/*
dayMeal
day
meal
type
*/
$day->addMeal($dayMeal);


            }
        }
/*


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
*/
        $day->calculateNutrition();

        $em = $this->getDoctrine()->getManager();
        $em->persist($day);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Zapisano dzień.');

        // Redirect - This is important to prevent users re-posting the form if they refresh the page
        return $this->redirect($this->generateUrl('mount_diet_days'), 201);
    }
}
