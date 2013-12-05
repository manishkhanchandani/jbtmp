<?php
namespace Jobs\ServiceBundle\Models;

use Symfony\Component\Templating\EngineInterface;

class Email
{
    protected $mailer;

    protected $templating;

    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function send($template, $params=array())
    {
        $message = \Swift_Message::newInstance()
                ->setSubject($params['subject'])
                ->setFrom($params['from'])
                ->setTo($params['to'])
                ->setBody(
                $this->templating->render(
                        'JobsServiceBundle:Emails:'.$template, $params
                )
                )
        ;
        
        $this->mailer->send($message);
        return true;
    }
}