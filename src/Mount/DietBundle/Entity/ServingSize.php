<?php

namespace Mount\DietBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="serving_size")
 */
class ServingSize
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $size;

    /**
     * @ORM\OneToMany(targetEntity="Food", mappedBy="servingSize")
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
     * Set size
     *
     * @param string $size
     * @return ServingSize
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Add food
     *
     * @param \Mount\DietBundle\Entity\Food $food
     * @return ServingSize
     */
    public function addFood(\Mount\DietBundle\Entity\Food $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \Mount\DietBundle\Entity\Food $food
     */
    public function removeFood(\Mount\DietBundle\Entity\Food $food)
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
     * Returns serving size name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getSize();
    }

    /**
     * Returns multiplier used for calculating calories, carbs, etc per serving size
     *
     * @return void
     */
    public function getMultiplier()
    {
        if ($this->getSize() == 'grams') {
            return 100;
        }

        return 1;
    }
}
