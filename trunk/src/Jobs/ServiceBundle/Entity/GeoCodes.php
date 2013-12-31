<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoCodes
 */
class GeoCodes
{
    /**
     * @var integer
     */
    private $codeId;

    /**
     * @var integer
     */
    private $conId;

    /**
     * @var string
     */
    private $code;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var integer
     */
    private $ctyId;

    /**
     * @var integer
     */
    private $staId;


    /**
     * Get codeId
     *
     * @return integer 
     */
    public function getCodeId()
    {
        return $this->codeId;
    }

    /**
     * Set conId
     *
     * @param integer $conId
     * @return GeoCodes
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
     * Set code
     *
     * @param string $code
     * @return GeoCodes
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return GeoCodes
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
     * @return GeoCodes
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

    /**
     * Set ctyId
     *
     * @param integer $ctyId
     * @return GeoCodes
     */
    public function setCtyId($ctyId)
    {
        $this->ctyId = $ctyId;
    
        return $this;
    }

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
     * @return GeoCodes
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
}