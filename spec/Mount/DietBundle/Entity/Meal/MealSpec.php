<?php

namespace spec\Mount\DietBundle\Entity\Meal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use \Mount\DietBundle\Entity\Meal\Food;

class MealSpec extends ObjectBehavior
{
    function it_calculates_nutrition(Food $foodA, Food $foodB, Food $foodC)
    {
        $foodA->getCalories()->willReturn(100);

        $foodB->getCalories()->willReturn(300);

        $foodC->getCalories()->willReturn(200);

        $this->addFood($foodA);
        $this->addFood($foodB);
        $this->addFood($foodC);

        $this->calculateNutrition();

        $this->getCalories()->shouldBe(600);
    }
}
