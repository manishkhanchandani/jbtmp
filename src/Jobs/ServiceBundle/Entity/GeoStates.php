<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoStates
 */
class GeoStates
{
    /**
     * @var integer
     */
    private $staId;

    /**
     * @var integer
     */
    private $conId;

    /**
     * @var string
     */
    private $name;


    /**
     * Get staId
     *
     * @return integer 
     */
    public function getStaId()
    {
        return $this->staId;
    }

    /**
     * Set conId
     *
     * @param integer $conId
     * @return GeoStates
     */
    public function setConId($conId)
    {
        $this->conId = $conId;
    
        return $this;
    }

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
     * @return GeoStates
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