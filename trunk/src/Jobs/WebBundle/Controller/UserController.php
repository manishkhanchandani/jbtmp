<?php

namespace Jobs\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php', array());
    }

    public function loginAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php', array());
    }

    public function forgotAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php', array());
    }

    public function changeAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php', array());
    }

    public function logoutAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php', array());
    }
}
