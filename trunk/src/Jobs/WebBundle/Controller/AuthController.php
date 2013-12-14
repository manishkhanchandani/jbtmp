<?php
namespace Jobs\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function registerAction()
    {
        return $this->render('JobsWebBundle:Auth:register.html.php', array());
    }
    
    public function loginAction()
    {
        return $this->render('JobsWebBundle:Auth:login.html.php', array());
    }
    public function forgetPasswordAction()
    {
        return $this->render('JobsWebBundle:Auth:forgotPassword.html.php', array());
    }
    public function logoutAction()
    {
        return $this->render('JobsWebBundle:Auth:forgotPassword.html.php', array());
    }
}