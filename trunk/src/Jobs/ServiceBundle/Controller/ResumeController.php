<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Resumes;
use Jobs\ServiceBundle\Entity\ResumesRepository;
use Jobs\ServiceBundle\Models\ErrorCode;

class ResumeController extends MainController
{
    
    public function postAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $resumeId = guid();
            $created = tstobts(time());
            $resumes = new Resumes();
            $resumes->setResumeId($resumeId);
            $resumes->setUserId($this->userId);
            $resumes->setTitle($request->request->get('title'));
            $resumes->setResumeContact($request->request->get('contactNumber'));
            $resumes->setResumeAvail($request->request->get('startDate'));
            $resumes->setResumeWork($request->request->get('workAuthorization'));
            $resumes->setResumeEdu($request->request->get('education'));
            $resumes->setResumeSchool($request->request->get('school'));
            $resumes->setResumeMajor($request->request->get('major'));
            $resumes->setResumeWorkexp($request->request->get('experience'));
            $resumes->setResumeSkills($request->request->get('skillset'));
            $resumes->setResumePrefloc($request->request->get('location'));
            $resumes->setResumeCreatedDt($created);
            $resumes->setResumeDeleted(0);
            $resumes->setResumeDeletedTd(0);
            $resumes->setResumeModifiedDt($created);
            $resumes->setResumeStatus(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($resumes);
            $em->flush();
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'id' => $resumeId, 'post' => $_POST, 'files' => $_FILES);
        $json = json_encode($arr);
        return new Response($json);
    }
}