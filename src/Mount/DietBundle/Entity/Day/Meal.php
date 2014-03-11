<?php

namespace Mount\DietBundle\Entity\Day;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="day_meals")
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
     * @ORM\ManyToOne(targetEntity="Day", inversedBy="day_meals")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", nullable=false)
     */
    protected $day;

    /**
     * @ORM\ManyToOne(targetEntity="\Mount\DietBundle\Entity\Meal\Meal", inversedBy="day_meals")
     * @ORM\JoinColumn(name="meal_id", referencedColumnName="id", nullable=false)
     */
    protected $meal;

    /**
     * @ORM\ManyToOne(targetEntity="\Mount\DietBundle\Entity\Meal\Type", inversedBy="day_meals")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

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
     * Set day
     *
     * @param \Mount\DietBundle\Entity\Day\Day $day
     * @return Meal
     */
    public function setDay(\Mount\DietBundle\Entity\Day\Day $day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \Mount\DietBundle\Entity\Day\Day
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set meal
     *
     * @param \Mount\DietBundle\Entity\Meal\Meal $meal
     * @return Meal
     */
    public function setMeal(\Mount\DietBundle\Entity\Meal\Meal $meal)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return \Mount\DietBundle\Entity\Meal\Meal
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set type
     *
     * @param \Mount\DietBundle\Entity\Meal\Type $type
     * @return Meal
     */
    public function setType(\Mount\DietBundle\Entity\Meal\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Mount\DietBundle\Entity\Meal\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isBreakfast()
    {
        return $this->getType()->isBreakfast();
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSecondBreakfast()
    {
        return $this->getType()->isSecondBreakfast();
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isDinner()
    {
        return $this->getType()->isDinner();
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isTea()
    {
        return $this->getType()->isTea();
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSupper()
    {
        return $this->getType()->isSupper();
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSpecial()
    {
        return $this->getType()->isSpecial();
    }
}