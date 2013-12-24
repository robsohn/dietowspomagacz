<?php

namespace spec\Mount\DietBundle\Entity\Meal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FoodSpec extends ObjectBehavior
{
    function it_calculate_nutrition(
        \Mount\DietBundle\Entity\Food\Food $food, \Mount\DietBundle\Entity\ServingSize $serving
    ) {
        $serving->getMultiplier()->willReturn(100);
        $food->getServingSize()->willReturn($serving);
        $food->getCalories()->willReturn(500);
        $food->getProtein()->willReturn(40);
        $food->getCarbs()->willReturn(100);
        $food->getFat()->willReturn(20);

        $this->setFood($food);

        $this->setServing(50);
        $this->calculateNutrition();

        $this->getCalories()->shouldBe(250);
        $this->getProtein()->shouldBe(20);
        $this->getCarbs()->shouldBe(50);
        $this->getFat()->shouldBe(10);
    }
}
