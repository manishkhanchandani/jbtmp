<?php

// src/Jobs/ServiceBundle/Controller/AccountController.php
namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Form\Type\RegistrationType;
use Jobs\ServiceBundle\Form\Model\Registration;
use Jobs\ServiceBundle\Entity\Users;
use Jobs\ServiceBundle\Form\Type\UsersType;

class AccountController extends Controller
{
    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return $this->render(
            'JobsServiceBundle:Account:register.html.php',
            array('form' => $form->createView())
        );
    }
    public function register2Action()
    {
        $users = new Users();
        $form = $this->createForm(new UsersType(), $users, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return $this->render(
            'JobsServiceBundle:Account:register.html.php',
            array('form' => $form->createView())
        );
    }
}