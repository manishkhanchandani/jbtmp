<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCountries
 */
class GeoCountries
{
    /**
     * @var integer
     */
    private $conId;

    /**
     * @var string
     */
    private $name;


    /**
     * Get conId
     *
     * @return integer 
     */
    public function getConId()
    {
        return $this->conId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return GeoCountries
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
}
