<?php

namespace Mount\DietBundle\Entity\Meal;

use Doctrine\ORM\EntityRepository;

/**
 * Meal Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Repository extends EntityRepository
{
    public function findAllSortedByName()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
