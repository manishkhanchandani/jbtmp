<?php
namespace Jobs\WebBundle\Controller;

use Jobs\WebBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EmployerController extends MainController
{
    public function postAction()
    {
        if (empty($_COOKIE['accessToken'])) {
            $this->session->set('_redirectURL', $url = $this->generateUrl('jobs_web_employer_post'));
            return $this->redirect($this->generateUrl('jobs_web_auth_login'));
        }
        $this->session->remove('_redirectURL');
        return $this->render('JobsWebBundle:Employer:post.html.php', array());
    }
    public function myjobsAction()
    {
        if (empty($_COOKIE['accessToken'])) {
            $this->session->set('_redirectURL', $url = $this->generateUrl('jobs_web_employer_myjobs'));
            return $this->redirect($this->generateUrl('jobs_web_auth_login'));
        }
        $this->session->remove('_redirectURL');
        return $this->render('JobsWebBundle:Employer:myjobs.html.php', array());
    }
    public function previewAction(Request $request)
    {
        if (empty($_COOKIE['accessToken'])) {
            $this->session->set('_redirectURL', $url = $this->generateUrl('jobs_web_employer_myjobs'));
            return $this->redirect($this->generateUrl('jobs_web_auth_login'));
        }
        $this->session->remove('_redirectURL');
        $jobId = $request->query->get('jobId');
        if (empty($jobId)) {
            header("Location: ".$this->generateUrl('jobs_web_employer_myjobs'));
            exit;
        }
        return $this->render('JobsWebBundle:Employer:previewJob.html.php', array('jobId' => $jobId));
    }
    public function searchAction()
    {
        return $this->render('JobsWebBundle:Employer:search.html.php', array());
    }
}