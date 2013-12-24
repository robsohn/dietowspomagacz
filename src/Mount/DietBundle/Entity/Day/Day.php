<?php

namespace Mount\DietBundle\Entity\Day;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mount\DietBundle\Entity\Day\Repository")
 * @ORM\Table(name="days")
 */
class Day
{
    /**
     * Date format used in URLs
     */
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
     * @ORM\OneToMany(targetEntity="Meal", mappedBy="meals", cascade={"persist"})
     */
    protected $meals;

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

    protected $breakfastCollection = null;
    protected $secondBreakfastCollection = null;
    protected $dinnerCollection = null;
    protected $teaCollection = null;
    protected $supperCollection = null;
    protected $specialCollection = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meals = new \Doctrine\Common\Collections\ArrayCollection();
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
            throw new \InvalidArgumentException('Invalid date format');
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
     * Calculates nutrition of a day
     * @return void
     */
    public function calculateNutrition()
    {
        $calories = 0;
        $protein = 0;
        $carbs = 0;
        $fat = 0;

        foreach ($this->getMeals() as $meal) {
            $calories += $meal->getCalories();
            $protein += $meal->getProtein();
            $carbs += $meal->getCarbs();
            $fat += $meal->getFat();
        }

        $this->setCalories($calories);
        $this->setProtein($protein);
        $this->setCarbs($carbs);
        $this->setFat($fat);
    }

    /**
     * Add meals
     *
     * @param \Mount\DietBundle\Entity\Day\Meal $meals
     * @return Day
     */
    public function addMeal(\Mount\DietBundle\Entity\Day\Meal $meals)
    {
        $this->meals[] = $meals;

        return $this;
    }

    /**
     * Remove meals
     *
     * @param \Mount\DietBundle\Entity\Day\Meal $meals
     */
    public function removeMeal(\Mount\DietBundle\Entity\Day\Meal $meals)
    {
        $this->meals->removeElement($meals);
    }

    /**
     * Get meals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * Returns collection of meals
     * @return \ArrayObject Collection of meals
     */
    public function getBreakfast()
    {
        return $this->getMealByType('breakfast');
    }

    /**
     * Returns collection of meals
     * @return \ArrayObject Collection of meals
     */
    public function getSecondBreakfast()
    {
        return $this->getMealByType('secondBreakfast');
    }

    /**
     * Returns collection of meals
     * @return \ArrayObject Collection of meals
     */
    public function getDinner()
    {
        return $this->getMealByType('dinner');
    }

    /**
     * Returns collection of meals
     * @return \ArrayObject Collection of meals
     */
    public function getTea()
    {
        return $this->getMealByType('tea');
    }

    /**
     * Returns collection of meals
     * @return \ArrayObject Collection of meals
     */
    public function getSupper()
    {
        return $this->getMealByType('supper');
    }

    private function getMealByType($type)
    {
        $collectionName = $type . 'Collection';
        if (! is_null($this->{$collectionName})) {
            return $this->{$collectionName};
        }

        $method = 'is' . ucfirst($type);
        $collection = new \ArrayObject();

        foreach ($this->getMeals() as $meal) {
            if ($meal->$method()) {
                $collection[] = $meal;
            }
        }

        $this->{$collectionName} = $collection;
        return $collection;
    }
}
