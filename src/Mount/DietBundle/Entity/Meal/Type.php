<?php

namespace Mount\DietBundle\Entity\Meal;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type
 *
 * @ORM\Table(name="meal_types")
 * @ORM\Entity
 */
class Type
{
    const BREAKFAST = 'breakfast';
    const SECOND_BREAKFAST = 'second_breakfast';
    const DINNER = 'dinner';
    const TEA = 'tea';
    const SUPPER = 'supper';
    const SPECIAL = 'special';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="handle", type="string", length=32)
     */
    protected $handle;

    /**
     * @var ArrayCollection
     */
    protected $meals;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
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
     * @return MealType
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
     * Returns meal type name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set handle
     *
     * @param string $handle
     * @return Type
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Get handle
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isBreakfast()
    {
        return ($this->getHandle() == self::BREAKFAST);
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSecondBreakfast()
    {
        return ($this->getHandle() == self::SECOND_BREAKFAST);
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isDinner()
    {
        return ($this->getHandle() == self::DINNER);
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isTea()
    {
        return ($this->getHandle() == self::TEA);
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSupper()
    {
        return ($this->getHandle() == self::SUPPER);
    }

    /**
     * Checks for specific meal type
     * @return boolean
     */
    public function isSpecial()
    {
        return ($this->getHandle() == self::SPECIAL);
    }
}
