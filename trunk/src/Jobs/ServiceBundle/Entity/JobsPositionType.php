<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobsPositionType
 */
class JobsPositionType
{
    /**
     * @var string
     */
    private $jobId;

    /**
     * @var integer
     */
    private $positionType;

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
    /**
     * @var \Jobs\ServiceBundle\Entity\Jobs
     */
    private $job;


    /**
     * Set job
     *
     * @param \Jobs\ServiceBundle\Entity\Jobs $job
     * @return JobsPositionType
     */
    public function setJob(\Jobs\ServiceBundle\Entity\Jobs $job = null)
    {
        $this->job = $job;
    
        return $this;
    }

    /**
     * Get job
     *
     * @return \Jobs\ServiceBundle\Entity\Jobs 
     */
    public function getJob()
    {
        return $this->job;
    }
    /**
     * @var integer
     */
    private $positionId;


    /**
     * Get positionId
     *
     * @return integer 
     */
    public function getPositionId()
    {
        return $this->positionId;
    }
}