<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobsPositionType
 */
class JobsPositionType
{
    /**
     * @var integer
     */
    private $positionId;

    /**
     * @var string
     */
    private $jobId;

    /**
     * @var integer
     */
    private $positionType;


    /**
     * Get positionId
     *
     * @return integer 
     */
    public function getPositionId()
    {
        return $this->positionId;
    }

    /**
     * Set jobId
     *
     * @param string $jobId
     * @return JobsPositionType
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    
        return $this;
    }

    /**
     * Get jobId
     *
     * @return string 
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * Set positionType
     *
     * @param integer $positionType
     * @return JobsPositionType
     */
    public function setPositionType($positionType)
    {
        $this->positionType = $positionType;
    
        return $this;
    }

    /**
     * Get positionType
     *
     * @return integer 
     */
    public function getPositionType()
    {
        return $this->positionType;
    }
}
