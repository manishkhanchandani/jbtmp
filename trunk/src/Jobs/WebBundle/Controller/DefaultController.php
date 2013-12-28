<?php

namespace Jobs\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JobsWebBundle:Default:index.html.php');
    }
}
