<?php

namespace Mount\DietBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class Day
{
   protected $id;

   /**
    * date in format YYYY-MM-DD
    *
    * @var string
    */
   protected $date;

   /**
    * setDate
    *
    * @param string $date Must be in format YYYY-MM-DD
    * @return Mount\DietBundle\Entity\Day
    */
   public function setDate($date)
   {
       //TODO add validation
       $this->date = $date;
       return $this;
   }

   /**
    * getDate
    *
    * @return string
    */
   public function getDate()
   {
       return $this->date;
   }
}
