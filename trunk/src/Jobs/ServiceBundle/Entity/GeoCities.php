<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCities
 */
class GeoCities
{
    /**
     * @var integer
     */
    private $ctyId;

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
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;


    /**
     * Get ctyId
     *
     * @return integer 
     */
    public function getCtyId()
    {
        return $this->ctyId;
    }

    /**
     * Set staId
     *
     * @param integer $staId
     * @return GeoCities
     */
    public function setStaId($staId)
    {
        $this->staId = $staId;
    
        return $this;
    }

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
     * @return GeoCities
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
     * @return GeoCities
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
     * Set latitude
     *
     * @param float $latitude
     * @return GeoCities
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return GeoCities
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}