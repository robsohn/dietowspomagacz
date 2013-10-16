<?php

namespace Mount\DietBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mount\DietBundle\Entity\DayRepository")
 * @ORM\Table(name="days")
 */
class Day
{
    const URL_DATE_FORMAT = 'Ymd';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * date in format YYYY-MM-DD
     *
     * @ORM\Column(type="date", unique=true)
     * @var string
     */
    protected $date;

    /**
     * @ORM\OneToOne(targetEntity="Meal")
     * @ORM\JoinColumn(name="breakfast", referencedColumnName="id", nullable=false)
     */
    protected $breakfast;

    /**
     * @ORM\OneToOne(targetEntity="Meal")
     * @ORM\JoinColumn(name="second_breakfast", referencedColumnName="id", nullable=false)
     */
    protected $secondBreakfast;

    /**
     * @ORM\OneToOne(targetEntity="Meal")
     * @ORM\JoinColumn(name="dinner", referencedColumnName="id", nullable=false)
     */
    protected $dinner;

    /**
     * @ORM\OneToOne(targetEntity="Meal")
     * @ORM\JoinColumn(name="tea", referencedColumnName="id", nullable=false)
     */
    protected $tea;

    /**
     * @ORM\OneToOne(targetEntity="Meal")
     * @ORM\JoinColumn(name="supper", referencedColumnName="id", nullable=false)
     */
    protected $supper;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Day
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Sets date from string, format is based on constant
     * @param string $date
     * @return Day
     * @throws InvalidArgumentException If invalid date
     */
    public function setDateFromString($date)
    {
        $date = \DateTime::createFromFormat(self::URL_DATE_FORMAT, $date);

        if (!$date) {
            throw new \InvalidArgumentException('Invalid date');
        }

        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set calories
     *
     * @param float $calories
     * @return Day
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * Get calories
     *
     * @return float
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Set protein
     *
     * @param float $protein
     * @return Day
     */
    public function setProtein($protein)
    {
        $this->protein = $protein;

        return $this;
    }

    /**
     * Get protein
     *
     * @return float
     */
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * Set carbs
     *
     * @param float $carbs
     * @return Day
     */
    public function setCarbs($carbs)
    {
        $this->carbs = $carbs;

        return $this;
    }

    /**
     * Get carbs
     *
     * @return float
     */
    public function getCarbs()
    {
        return $this->carbs;
    }

    /**
     * Set fat
     *
     * @param float $fat
     * @return Day
     */
    public function setFat($fat)
    {
        $this->fat = $fat;

        return $this;
    }

    /**
     * Get fat
     *
     * @return float
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * Set breakfast
     *
     * @param \Mount\DietBundle\Entity\Meal $breakfast
     * @return Day
     */
    public function setBreakfast(\Mount\DietBundle\Entity\Meal $breakfast)
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    /**
     * Get breakfast
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getBreakfast()
    {
        return $this->breakfast;
    }

    /**
     * Set dinner
     *
     * @param \Mount\DietBundle\Entity\Meal $dinner
     * @return Day
     */
    public function setDinner(\Mount\DietBundle\Entity\Meal $dinner)
    {
        $this->dinner = $dinner;

        return $this;
    }

    /**
     * Get dinner
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getDinner()
    {
        return $this->dinner;
    }

    /**
     * Set tea
     *
     * @param \Mount\DietBundle\Entity\Meal $tea
     * @return Day
     */
    public function setTea(\Mount\DietBundle\Entity\Meal $tea)
    {
        $this->tea = $tea;

        return $this;
    }

    /**
     * Get tea
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getTea()
    {
        return $this->tea;
    }

    /**
     * Set supper
     *
     * @param \Mount\DietBundle\Entity\Meal $supper
     * @return Day
     */
    public function setSupper(\Mount\DietBundle\Entity\Meal $supper)
    {
        $this->supper = $supper;

        return $this;
    }

    /**
     * Get supper
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getSupper()
    {
        return $this->supper;
    }

    /**
     * Set secondBreakfast
     *
     * @param \Mount\DietBundle\Entity\Meal $secondBreakfast
     * @return Day
     */
    public function setSecondBreakfast(\Mount\DietBundle\Entity\Meal $secondBreakfast)
    {
        $this->secondBreakfast = $secondBreakfast;

        return $this;
    }

    /**
     * Get secondBreakfast
     *
     * @return \Mount\DietBundle\Entity\Meal
     */
    public function getSecondBreakfast()
    {
        return $this->secondBreakfast;
    }

    /**
     * Calculates nutrition of a day
     * @return void
     */
    public function calculateNutrition()
    {
        $breakfast = $this->getBreakfast();
        $secondBreakfast = $this->getSecondBreakfast();
        $dinner = $this->getDinner();
        $tea = $this->getTea();
        $supper = $this->getsupper();

        $this->calories = $breakfast->getCalories() + $secondBreakfast->getCalories()
            + $dinner->getCalories() + $tea->getCalories() + $supper->getCalories();

        $this->protein = $breakfast->getProtein() + $secondBreakfast->getProtein()
            + $dinner->getProtein() + $tea->getProtein() + $supper->getProtein();

        $this->carbs = $breakfast->getCarbs() + $secondBreakfast->getCarbs()
            + $dinner->getCarbs() + $tea->getCarbs() + $supper->getCarbs();

        $this->fat = $breakfast->getFat() + $secondBreakfast->getFat()
            + $dinner->getFat() + $tea->getFat() + $supper->getFat();
    }
}
