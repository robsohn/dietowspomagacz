<?php

namespace Mount\DietBundle\Entity\Meal;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Mount\DietBundle\Entity\Meal\Repository")
 * @ORM\Table(name="meals")
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

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
     * food
     *
     * @ORM\OneToMany(targetEntity="Food", mappedBy="meal", cascade={"persist"})
     *
     * @var MealFood
     */
    protected $food;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->food = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Meal
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set calories
     *
     * @param integer $calories
     * @return Meal
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
     * @return Meal
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
     * @return Meal
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
     * @return Meal
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
     * Add food
     *
     * @param \Mount\DietBundle\Entity\Meal\Food $food
     * @return Meal
     */
    public function addFood(\Mount\DietBundle\Entity\Meal\Food $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \Mount\DietBundle\Entity\Meal\Food $food
     */
    public function removeFood(\Mount\DietBundle\Entity\Meal\Food $food)
    {
        $this->food->removeElement($food);
    }

    /**
     * Get food
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Calculates meal nutrition
     * @return void
     */
    public function calculateNutrition()
    {
        $calories = 0;
        $protein = 0;
        $carbs = 0;
        $fat = 0;

        foreach ($this->getFood() as $food) {
            $calories += $food->getCalories();
            $protein += $food->getProtein();
            $carbs += $food->getCarbs();
            $fat += $food->getFat();
        }

        $this->setCalories($calories);
        $this->setProtein($protein);
        $this->setCarbs($carbs);
        $this->setFat($fat);
    }
}
