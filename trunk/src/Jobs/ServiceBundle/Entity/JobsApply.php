<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobsApply
 */
class JobsApply
{
    /**
     * @var integer
     */
    private $aid;

    /**
     * @var string
     */
    private $jobId;

    /**
     * @var string
     */
    private $applyId;

    /**
     * @var \DateTime
     */
    private $applyDate;

    /**
     * @var string
     */
    private $applyName;

    /**
     * @var string
     */
    private $applyEmail;


    /**
     * Get aid
     *
     * @return integer 
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set jobId
     *
     * @param string $jobId
     * @return JobsApply
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
     * Set applyId
     *
     * @param string $applyId
     * @return JobsApply
     */
    public function setApplyId($applyId)
    {
        $this->applyId = $applyId;
    
        return $this;
    }

    /**
     * Get applyId
     *
     * @return string 
     */
    public function getApplyId()
    {
        return $this->applyId;
    }

    /**
     * Set applyDate
     *
     * @param \DateTime $applyDate
     * @return JobsApply
     */
    public function setApplyDate($applyDate)
    {
        $this->applyDate = $applyDate;
    
        return $this;
    }

    /**
     * Get applyDate
     *
     * @return \DateTime 
     */
    public function getApplyDate()
    {
        return $this->applyDate;
    }

    /**
     * Set applyName
     *
     * @param string $applyName
     * @return JobsApply
     */
    public function setApplyName($applyName)
    {
        $this->applyName = $applyName;
    
        return $this;
    }

    /**
     * Get applyName
     *
     * @return string 
     */
    public function getApplyName()
    {
        return $this->applyName;
    }

    /**
     * Set applyEmail
     *
     * @param string $applyEmail
     * @return JobsApply
     */
    public function setApplyEmail($applyEmail)
    {
        $this->applyEmail = $applyEmail;
    
        return $this;
    }

    /**
     * Get applyEmail
     *
     * @return string 
     */
    public function getApplyEmail()
    {
        return $this->applyEmail;
    }
}
