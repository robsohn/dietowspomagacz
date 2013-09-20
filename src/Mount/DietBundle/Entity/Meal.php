<?php

namespace Mount\DietBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Mount\DietBundle\Entity\MealRepository")
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
     * @ORM\ManyToOne(targetEntity="MealType", inversedBy="meals")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * food
     *
     * @ORM\OneToMany(targetEntity="MealFood", mappedBy="meal", cascade={"persist"})
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
     * Set type
     *
     * @param \Mount\DietBundle\Entity\MealType $type
     * @return Meal
     */
    public function setType(\Mount\DietBundle\Entity\MealType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Mount\DietBundle\Entity\MealType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add food
     *
     * @param \Mount\DietBundle\Entity\MealFood $food
     * @return Meal
     */
    public function addFood(\Mount\DietBundle\Entity\MealFood $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \Mount\DietBundle\Entity\MealFood $food
     */
    public function removeFood(\Mount\DietBundle\Entity\MealFood $food)
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
}
