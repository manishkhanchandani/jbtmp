<?php

namespace Jobs\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function registerAction()
    {
        return $this->render('JobsWebBundle:Default:register.html.php', array());
    }

    public function registercompleteAction()
    {
        $array = array('success' => 1, 'message' => 'Submitted');
        $json = json_encode($array);
        return new Response($json);
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
