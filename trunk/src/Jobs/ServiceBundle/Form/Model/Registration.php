<?php

// src/Jobs/ServiceBundle/Form/Model/Registration.php
namespace Jobs\ServiceBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Jobs\ServiceBundle\Entity\Users;

class Registration
{
    /**
     * @Assert\Type(type="Jobs\ServiceBundle\Entity\Users")
     * @Assert\Valid()
     */
    protected $users;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setUsers(Users $users)
    {
        $this->users = $users;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
}