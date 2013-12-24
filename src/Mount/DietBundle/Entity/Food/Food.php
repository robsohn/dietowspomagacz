<?php

namespace Mount\DietBundle\Entity\Food;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mount\DietBundle\Entity\Food\Repository")
 * @ORM\Table(name="food")
 */
class Food
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
     * @ORM\ManyToOne(targetEntity="\Mount\DietBundle\Entity\ServingSize", inversedBy="food")
     * @ORM\JoinColumn(name="serving_size_id", referencedColumnName="id", nullable=false)
     */
    protected $servingSize;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="food")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

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
     * Set calories
     *
     * @param integer $calories
     * @return Food
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
     * @return Food
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
     * @return Food
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
     * @return Food
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
     * Set category
     *
     * @param \Mount\DietBundle\Entity\Food\Category $category
     * @return Food
     */
    public function setCategory(\Mount\DietBundle\Entity\Food\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mount\DietBundle\Entity\Food\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set servingSize
     *
     * @param \Mount\DietBundle\Entity\ServingSize $servingSize
     * @return Food
     */
    public function setServingSize(\Mount\DietBundle\Entity\ServingSize $servingSize = null)
    {
        $this->servingSize = $servingSize;

        return $this;
    }

    /**
     * Get servingSize
     *
     * @return \Mount\DietBundle\Entity\ServingSize
     */
    public function getServingSize()
    {
        return $this->servingSize;
    }
}
