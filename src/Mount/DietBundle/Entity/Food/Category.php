<?php

namespace Mount\DietBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="food_categories")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Food", mappedBy="category")
     */
    protected $food;

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
     * @return Food
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
     * Add food
     *
     * @param \Mount\DietBundle\Entity\Food\Food $food
     * @return FoodCategory
     */
    public function addFood(\Mount\DietBundle\Entity\Food\Food $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \Mount\DietBundle\Entity\Food\Food $food
     */
    public function removeFood(\Mount\DietBundle\Entity\Food\Food $food)
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
     * Returns category name
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
