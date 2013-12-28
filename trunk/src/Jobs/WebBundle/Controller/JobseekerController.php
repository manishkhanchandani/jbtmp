<?php
namespace Jobs\WebBundle\Controller;

use Jobs\WebBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JobseekerController extends MainController
{
    public function postAction()
    {
        if (empty($_COOKIE['accessToken'])) {
            $this->session->set('_redirectURL', $url = $this->generateUrl('jobs_web_jobseeker_post'));
            return $this->redirect($this->generateUrl('jobs_web_auth_login'));
        }
        $this->session->remove('_redirectURL');
        return $this->render('JobsWebBundle:Jobseeker:post.html.php', array());
    }
    public function previewAction(Request $request)
    {
        if (empty($_COOKIE['accessToken'])) {
            $this->session->set('_redirectURL', $url = $this->generateUrl('jobs_web_jobseeker_preview'));
            return $this->redirect($this->generateUrl('jobs_web_auth_login'));
        }
        $id = $request->query->get('id');
        $this->session->remove('_redirectURL');
        return $this->render('JobsWebBundle:Jobseeker:preview.html.php', array('id' => $id));
    }
}