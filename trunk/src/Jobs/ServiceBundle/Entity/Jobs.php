<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jobs
 */
class Jobs
{
    /**
     * @var string
     */
    private $jobId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $positionType;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $areaCode;

    /**
     * @var string
     */
    private $zipcode;

    /**
     * @var string
     */
    private $skills;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $applicationMethod;

    /**
     * @var string
     */
    private $applicationEmail;

    /**
     * @var string
     */
    private $applicationEmailCc;

    /**
     * @var string
     */
    private $applicationUrl;

    /**
     * @var integer
     */
    private $showName;

    /**
     * @var integer
     */
    private $showAddress1;

    /**
     * @var integer
     */
    private $showAddress2;

    /**
     * @var integer
     */
    private $showCity;

    /**
     * @var integer
     */
    private $showZipcode;

    /**
     * @var integer
     */
    private $showPhone;

    /**
     * @var integer
     */
    private $showEmail;

    /**
     * @var integer
     */
    private $jobCreatedDt;

    /**
     * @var integer
     */
    private $jobModifiedDt;

    /**
     * @var integer
     */
    private $jobDeletedDt;

    /**
     * @var integer
     */
    private $jobDeleted;

    /**
     * @var integer
     */
    private $jobStatus;


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
     * Set userId
     *
     * @param string $userId
     * @return Jobs
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
     * Set title
     *
     * @param string $title
     * @return Jobs
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set positionType
     *
     * @param integer $positionType
     * @return Jobs
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
     * Set city
     *
     * @param string $city
     * @return Jobs
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Jobs
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Jobs
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode
     * @return Jobs
     */
    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    
        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string 
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Jobs
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return Jobs
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    
        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Jobs
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set applicationMethod
     *
     * @param integer $applicationMethod
     * @return Jobs
     */
    public function setApplicationMethod($applicationMethod)
    {
        $this->applicationMethod = $applicationMethod;
    
        return $this;
    }

    /**
     * Get applicationMethod
     *
     * @return integer 
     */
    public function getApplicationMethod()
    {
        return $this->applicationMethod;
    }

    /**
     * Set applicationEmail
     *
     * @param string $applicationEmail
     * @return Jobs
     */
    public function setApplicationEmail($applicationEmail)
    {
        $this->applicationEmail = $applicationEmail;
    
        return $this;
    }

    /**
     * Get applicationEmail
     *
     * @return string 
     */
    public function getApplicationEmail()
    {
        return $this->applicationEmail;
    }

    /**
     * Set applicationEmailCc
     *
     * @param string $applicationEmailCc
     * @return Jobs
     */
    public function setApplicationEmailCc($applicationEmailCc)
    {
        $this->applicationEmailCc = $applicationEmailCc;
    
        return $this;
    }

    /**
     * Get applicationEmailCc
     *
     * @return string 
     */
    public function getApplicationEmailCc()
    {
        return $this->applicationEmailCc;
    }

    /**
     * Set applicationUrl
     *
     * @param string $applicationUrl
     * @return Jobs
     */
    public function setApplicationUrl($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    
        return $this;
    }

    /**
     * Get applicationUrl
     *
     * @return string 
     */
    public function getApplicationUrl()
    {
        return $this->applicationUrl;
    }

    /**
     * Set showName
     *
     * @param integer $showName
     * @return Jobs
     */
    public function setShowName($showName)
    {
        $this->showName = $showName;
    
        return $this;
    }

    /**
     * Get showName
     *
     * @return integer 
     */
    public function getShowName()
    {
        return $this->showName;
    }

    /**
     * Set showAddress1
     *
     * @param integer $showAddress1
     * @return Jobs
     */
    public function setShowAddress1($showAddress1)
    {
        $this->showAddress1 = $showAddress1;
    
        return $this;
    }

    /**
     * Get showAddress1
     *
     * @return integer 
     */
    public function getShowAddress1()
    {
        return $this->showAddress1;
    }

    /**
     * Set showAddress2
     *
     * @param integer $showAddress2
     * @return Jobs
     */
    public function setShowAddress2($showAddress2)
    {
        $this->showAddress2 = $showAddress2;
    
        return $this;
    }

    /**
     * Get showAddress2
     *
     * @return integer 
     */
    public function getShowAddress2()
    {
        return $this->showAddress2;
    }

    /**
     * Set showCity
     *
     * @param integer $showCity
     * @return Jobs
     */
    public function setShowCity($showCity)
    {
        $this->showCity = $showCity;
    
        return $this;
    }

    /**
     * Get showCity
     *
     * @return integer 
     */
    public function getShowCity()
    {
        return $this->showCity;
    }

    /**
     * Set showZipcode
     *
     * @param integer $showZipcode
     * @return Jobs
     */
    public function setShowZipcode($showZipcode)
    {
        $this->showZipcode = $showZipcode;
    
        return $this;
    }

    /**
     * Get showZipcode
     *
     * @return integer 
     */
    public function getShowZipcode()
    {
        return $this->showZipcode;
    }

    /**
     * Set showPhone
     *
     * @param integer $showPhone
     * @return Jobs
     */
    public function setShowPhone($showPhone)
    {
        $this->showPhone = $showPhone;
    
        return $this;
    }

    /**
     * Get showPhone
     *
     * @return integer 
     */
    public function getShowPhone()
    {
        return $this->showPhone;
    }

    /**
     * Set showEmail
     *
     * @param integer $showEmail
     * @return Jobs
     */
    public function setShowEmail($showEmail)
    {
        $this->showEmail = $showEmail;
    
        return $this;
    }

    /**
     * Get showEmail
     *
     * @return integer 
     */
    public function getShowEmail()
    {
        return $this->showEmail;
    }

    /**
     * Set jobCreatedDt
     *
     * @param integer $jobCreatedDt
     * @return Jobs
     */
    public function setJobCreatedDt($jobCreatedDt)
    {
        $this->jobCreatedDt = $jobCreatedDt;
    
        return $this;
    }

    /**
     * Get jobCreatedDt
     *
     * @return integer 
     */
    public function getJobCreatedDt()
    {
        return $this->jobCreatedDt;
    }

    /**
     * Set jobModifiedDt
     *
     * @param integer $jobModifiedDt
     * @return Jobs
     */
    public function setJobModifiedDt($jobModifiedDt)
    {
        $this->jobModifiedDt = $jobModifiedDt;
    
        return $this;
    }

    /**
     * Get jobModifiedDt
     *
     * @return integer 
     */
    public function getJobModifiedDt()
    {
        return $this->jobModifiedDt;
    }

    /**
     * Set jobDeletedDt
     *
     * @param integer $jobDeletedDt
     * @return Jobs
     */
    public function setJobDeletedDt($jobDeletedDt)
    {
        $this->jobDeletedDt = $jobDeletedDt;
    
        return $this;
    }

    /**
     * Get jobDeletedDt
     *
     * @return integer 
     */
    public function getJobDeletedDt()
    {
        return $this->jobDeletedDt;
    }

    /**
     * Set jobDeleted
     *
     * @param integer $jobDeleted
     * @return Jobs
     */
    public function setJobDeleted($jobDeleted)
    {
        $this->jobDeleted = $jobDeleted;
    
        return $this;
    }

    /**
     * Get jobDeleted
     *
     * @return integer 
     */
    public function getJobDeleted()
    {
        return $this->jobDeleted;
    }

    /**
     * Set jobStatus
     *
     * @param integer $jobStatus
     * @return Jobs
     */
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = $jobStatus;
    
        return $this;
    }

    /**
     * Get jobStatus
     *
     * @return integer 
     */
    public function getJobStatus()
    {
        return $this->jobStatus;
    }

    /**
     * Set jobId
     *
     * @param string $jobId
     * @return Jobs
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    
        return $this;
    }
    /**
     * @var integer
     */
    private $showState;


    /**
     * Set showState
     *
     * @param integer $showState
     * @return Jobs
     */
    public function setShowState($showState)
    {
        $this->showState = $showState;
    
        return $this;
    }

    /**
     * Get showState
     *
     * @return integer 
     */
    public function getShowState()
    {
        return $this->showState;
    }
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;


    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Jobs
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
     * @return Jobs
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