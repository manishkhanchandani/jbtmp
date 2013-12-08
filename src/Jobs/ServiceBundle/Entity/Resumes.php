<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resumes
 */
class Resumes
{
    /**
     * @var string
     */
    private $resumeId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $resumeTitle;

    /**
     * @var integer
     */
    private $resumeShow;

    /**
     * @var string
     */
    private $resumeContent;

    /**
     * @var integer
     */
    private $resumeType;

    /**
     * @var string
     */
    private $resumeSkills;

    /**
     * @var integer
     */
    private $resumeCreatedDt;

    /**
     * @var integer
     */
    private $resumeModifiedDt;

    /**
     * @var integer
     */
    private $resumeDeletedTd;

    /**
     * @var integer
     */
    private $resumeStatus;

    /**
     * @var integer
     */
    private $resumeDeleted;


    /**
     * Get resumeId
     *
     * @return string 
     */
    public function getResumeId()
    {
        return $this->resumeId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return Resumes
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set resumeTitle
     *
     * @param string $resumeTitle
     * @return Resumes
     */
    public function setResumeTitle($resumeTitle)
    {
        $this->resumeTitle = $resumeTitle;
    
        return $this;
    }

    /**
     * Get resumeTitle
     *
     * @return string 
     */
    public function getResumeTitle()
    {
        return $this->resumeTitle;
    }

    /**
     * Set resumeShow
     *
     * @param integer $resumeShow
     * @return Resumes
     */
    public function setResumeShow($resumeShow)
    {
        $this->resumeShow = $resumeShow;
    
        return $this;
    }

    /**
     * Get resumeShow
     *
     * @return integer 
     */
    public function getResumeShow()
    {
        return $this->resumeShow;
    }

    /**
     * Set resumeContent
     *
     * @param string $resumeContent
     * @return Resumes
     */
    public function setResumeContent($resumeContent)
    {
        $this->resumeContent = $resumeContent;
    
        return $this;
    }

    /**
     * Get resumeContent
     *
     * @return string 
     */
    public function getResumeContent()
    {
        return $this->resumeContent;
    }

    /**
     * Set resumeType
     *
     * @param integer $resumeType
     * @return Resumes
     */
    public function setResumeType($resumeType)
    {
        $this->resumeType = $resumeType;
    
        return $this;
    }

    /**
     * Get resumeType
     *
     * @return integer 
     */
    public function getResumeType()
    {
        return $this->resumeType;
    }

    /**
     * Set resumeSkills
     *
     * @param string $resumeSkills
     * @return Resumes
     */
    public function setResumeSkills($resumeSkills)
    {
        $this->resumeSkills = $resumeSkills;
    
        return $this;
    }

    /**
     * Get resumeSkills
     *
     * @return string 
     */
    public function getResumeSkills()
    {
        return $this->resumeSkills;
    }

    /**
     * Set resumeCreatedDt
     *
     * @param integer $resumeCreatedDt
     * @return Resumes
     */
    public function setResumeCreatedDt($resumeCreatedDt)
    {
        $this->resumeCreatedDt = $resumeCreatedDt;
    
        return $this;
    }

    /**
     * Get resumeCreatedDt
     *
     * @return integer 
     */
    public function getResumeCreatedDt()
    {
        return $this->resumeCreatedDt;
    }

    /**
     * Set resumeModifiedDt
     *
     * @param integer $resumeModifiedDt
     * @return Resumes
     */
    public function setResumeModifiedDt($resumeModifiedDt)
    {
        $this->resumeModifiedDt = $resumeModifiedDt;
    
        return $this;
    }

    /**
     * Get resumeModifiedDt
     *
     * @return integer 
     */
    public function getResumeModifiedDt()
    {
        return $this->resumeModifiedDt;
    }

    /**
     * Set resumeDeletedTd
     *
     * @param integer $resumeDeletedTd
     * @return Resumes
     */
    public function setResumeDeletedTd($resumeDeletedTd)
    {
        $this->resumeDeletedTd = $resumeDeletedTd;
    
        return $this;
    }

    /**
     * Get resumeDeletedTd
     *
     * @return integer 
     */
    public function getResumeDeletedTd()
    {
        return $this->resumeDeletedTd;
    }

    /**
     * Set resumeStatus
     *
     * @param integer $resumeStatus
     * @return Resumes
     */
    public function setResumeStatus($resumeStatus)
    {
        $this->resumeStatus = $resumeStatus;
    
        return $this;
    }

    /**
     * Get resumeStatus
     *
     * @return integer 
     */
    public function getResumeStatus()
    {
        return $this->resumeStatus;
    }

    /**
     * Set resumeDeleted
     *
     * @param integer $resumeDeleted
     * @return Resumes
     */
    public function setResumeDeleted($resumeDeleted)
    {
        $this->resumeDeleted = $resumeDeleted;
    
        return $this;
    }

    /**
     * Get resumeDeleted
     *
     * @return integer 
     */
    public function getResumeDeleted()
    {
        return $this->resumeDeleted;
    }
}
