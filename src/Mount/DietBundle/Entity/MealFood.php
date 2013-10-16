<?php

namespace Mount\DietBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="meal_food")
 */
class MealFood
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Food", inversedBy="meal_food")
     * @ORM\JoinColumn(name="food_id", referencedColumnName="id", nullable=false)
     */
    protected $food;

    /**
     * @ORM\ManyToOne(targetEntity="Meal", inversedBy="meal_food")
     * @ORM\JoinColumn(name="meal_id", referencedColumnName="id", nullable=false)
     */
    protected $meal;

    /**
     * @ORM\Column(type="float")
     */
    protected $calories;

    /**
     * @ORM\Column(type="float")
     */
    protected $protein;

    /**
     * @ORM\Column(type="float")
     */
    protected $carbs;

    /**
     * @ORM\Column(type="float")
     */
    protected $fat;

    /**
     * @ORM\Column(type="integer")
     */
    protected $serving;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set calories
     *
     * @param integer $calories
     * @return MealFood
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * Get calories
     *
     * @return integer
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Set fat
     *
     * @param integer $fat
     * @return MealFood
     */
    public function setFat($fat)
    {
        $this->fat = $fat;

        return $this;
    }

    /**
     * Get fat
     *
     * @return integer
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * Set carbs
     *
     * @param integer $carbs
     * @return MealFood
     */
    public function setCarbs($carbs)
    {
        $this->carbs = $carbs;

        return $this;
    }

    /**
     * Get carbs
     *
     * @return integer
     */
    public function getCarbs()
    {
        return $this->carbs;
    }

    /**
     * Set protein
     *
     * @param integer $protein
     * @return MealFood
     */
    public function setProtein($protein)
    {
        $this->protein = $protein;

        return $this;
    }

    /**
     * Get protein
     *
     * @return integer
     */
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * Set serving
     *
     * @param integer $serving
     * @return MealFood
     */
    public function setServing($serving)
    {
        $this->serving = $serving;

        return $this;
    }

    /**
     * Get serving
     *
     * @return integer
     */
    public function getServing()
    {
        return $this->serving;
    }

    /**
     * Set food
     *
     * @param \Mount\DietBundle\Entity\Food $food
     * @return MealFood
     */
    public function setFood(\Mount\DietBundle\Entity\Food $food = null)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get food
     *
     * @return \Mount\DietBundle\Entity\Food
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set meal
     *
     * @param \Mount\DietBundle\Entity\Meal $meal
     * @return MealFood
     */
    public function setMeal(\Mount\DietBundle\Entity\Meal $meal = null)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getMeal()
    {
        return $this->meal;
    }
}
