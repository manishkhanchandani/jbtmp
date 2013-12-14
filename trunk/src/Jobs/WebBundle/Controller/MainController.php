<?php

namespace Jobs\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends Controller
{
    protected $session;
    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

}
?>
