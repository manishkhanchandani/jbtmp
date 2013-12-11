<?php

namespace Jobs\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 */
class Users
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $accessLevel;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var integer
     */
    private $created;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var integer
     */
    private $userType;


    /**
     * Set email
     *
     * @param string $email
     * @return Users
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
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set accessLevel
     *
     * @param string $accessLevel
     * @return Users
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = $accessLevel;
    
        return $this;
    }

    /**
     * Get accessLevel
     *
     * @return string 
     */
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Users
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Users
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Users
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Users
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set userType
     *
     * @param integer $userType
     * @return Users
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    
        return $this;
    }

    /**
     * Get userType
     *
     * @return integer 
     */
    public function getUserType()
    {
        return $this->userType;
    }
    /**
     * @var integer
     */
    private $modified;

    /**
     * @var integer
     */
    private $deletedDt;

    /**
     * @var integer
     */
    private $deleted;

    /**
     * @var string
     */
    private $tempPassword;


    /**
     * Set modified
     *
     * @param integer $modified
     * @return Users
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return integer 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set deletedDt
     *
     * @param integer $deletedDt
     * @return Users
     */
    public function setDeletedDt($deletedDt)
    {
        $this->deletedDt = $deletedDt;
    
        return $this;
    }

    /**
     * Get deletedDt
     *
     * @return integer 
     */
    public function getDeletedDt()
    {
        return $this->deletedDt;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Users
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set tempPassword
     *
     * @param string $tempPassword
     * @return Users
     */
    public function setTempPassword($tempPassword)
    {
        $this->tempPassword = $tempPassword;
    
        return $this;
    }

    /**
     * Get tempPassword
     *
     * @return string 
     */
    public function getTempPassword()
    {
        return $this->tempPassword;
    }
}