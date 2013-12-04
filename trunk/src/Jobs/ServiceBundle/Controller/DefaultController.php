<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        
            $name = 'manish';
            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('cintel.jobs@gmail.com')
                ->setTo('naveenkhanchandani@gmail.com')
                ->setBody(
                    $this->renderView(
                        'JobsServiceBundle:Emails:add.html.php',
                        array('name' => $name)
                    )
                )
            ;
            $this->get('mailer')->send($message);
        return $this->render('JobsServiceBundle:Default:index.html.twig', array('name' => $name));
    }
}
