<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Resumes;
use Jobs\ServiceBundle\Entity\ResumesRepository;
use Jobs\ServiceBundle\Models\ErrorCode;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ResumeController extends MainController
{
    const CODE_MISSING_ID = 1010;
    const CODE_INVALID_DATA = 1011;

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
            $resumes->setResumeTitle($request->request->get('title'));
            $resumes->setResumeContact($request->request->get('contactNumber'));
            $resumes->setResumeAvail($request->request->get('startDate'));
            $resumes->setResumeWork($request->request->get('workAuthorization'));
            $resumes->setResumeEdu($request->request->get('education'));
            $resumes->setResumeSchool($request->request->get('school'));
            $resumes->setResumeMajor($request->request->get('major'));
            $resumes->setResumeWorkexp($request->request->get('workExperience'));
            $resumes->setResumeSkills($request->request->get('skillSet'));
            $resumes->setResumePrefloc($request->request->get('location'));
            $resumes->setResumeCreatedDt($created);
            $resumes->setResumeDeleted(0);
            $resumes->setResumeDeletedTd(0);
            $resumes->setResumeModifiedDt($created);
            $resumes->setResumeStatus(1);
            // change this with symfony file later
            if (isset($_FILES['file']['name'])) {
                $folder = substr($this->userId, 0, 2);
                $dir = __DIR__.'/../../../../web/uploads/'.$folder.'/';
                $path = 'uploads/'.$folder.'/';
                $dir2 = $dir.$this->userId.'/';
                $path = $path.$this->userId;
                if (!is_dir($dir)) {
                    mkdir($dir, 0777);
                    chmod($dir, 0777);
                }
                if (!is_dir($dir2)) {
                    mkdir($dir2, 0777);
                    chmod($dir2, 0777);
                }
                $filename = realpath($dir2).'/'.$resumeId.'_'.$_FILES['file']['name'];
                $filesavepath = $path.'/'.$resumeId.'_'.$_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);
                $resumes->setResumeFilename($filesavepath);
            }
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
    
    
    public function previewAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $id = $request->query->get('id');
            $id = trim($id);
            if (empty($id)) {
                throw new \Exception(ErrorCode::getError(self::CODE_MISSING_ID), self::CODE_MISSING_ID);
            }
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('JobsServiceBundle:Resumes');
            $data = $repository->findOneByResumeId($id);
            if (empty($data)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_DATA), self::CODE_INVALID_DATA);
            }
            $return = array();
            $site_name = $this->container->getParameter('site_name');
            $host_url = $this->container->getParameter('host_url');
            //$data = new Resumes();
            $return['resumeId'] = $data->getResumeId();
            $return['userId'] = $data->getUserId();
            $return['resumeTitle'] = $data->getResumeTitle();
            $return['skillSet'] = $data->getResumeSkills();
            $return['startDate'] = $data->getResumeAvail();
            $return['workAuthorization'] = $data->getResumeWork();
            $return['education'] = $data->getResumeEdu();
            $return['school'] = $data->getResumeSchool();
            $return['major'] = $data->getResumeMajor();
            $return['location'] = $data->getResumePrefloc();
            $return['file'] = $data->getResumeFilename();
            $return['contactNumber'] = $data->getResumeContact();
            $return['url'] = !empty($return['file']) ? $host_url.'/'.$data->getResumeFilename() : null;
            $return['embedded_url'] = !empty($return['file']) ? 'https://docs.google.com/viewer?url='.urlencode($return['url']).'&embedded=true' : null;
            $return['workExperience'] = $data->getResumeWorkexp();
            $site_name_url = $this->container->getParameter('site_name_url');
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $return);
        $json = json_encode($arr);
        return new Response($json);
    }
    
    
    public function manageAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $this->init($request);
            //$key = 'countries';
            //$cache = $this->get('jobs_service.cachev1')->init();
            //$res = $cache->load($key);
            //if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT r from JobsServiceBundle:Resumes as r WHERE r.userId = ?1'
                );
                $query->setParameter(1, $this->userId);

                $dataResult = $query->getResult();
				$site_name = $this->container->getParameter('site_name');
            	$host_url = $this->container->getParameter('host_url');
                if (!empty($dataResult)) {
                    foreach ($dataResult as $k => $data) {
						$return = array();
						$return['resumeId'] = $data->getResumeId();
						$return['userId'] = $data->getUserId();
						$return['resumeTitle'] = $data->getResumeTitle();
						$return['skillset'] = $data->getResumeSkills();
						$return['startDate'] = $data->getResumeAvail();
						$return['workAuthorization'] = $data->getResumeWork();
						$return['education'] = $data->getResumeEdu();
						$return['school'] = $data->getResumeSchool();
						$return['major'] = $data->getResumeMajor();
						$return['location'] = $data->getResumePrefloc();
						$return['file'] = $data->getResumeFilename();
						$return['url'] = !empty($return['file']) ? $host_url.'/'.$data->getResumeFilename() : null;
						$return['embedded_url'] = !empty($return['file']) ? 'https://docs.google.com/viewer?url='.urlencode($return['url']).'&embedded=true' : null;
						$return['workExperience'] = $data->getResumeWorkexp();
                        //$res[$v->getName()] = $v->getConId();
                        $res[$k] = $return;
                    }
                }
                //$cache->save($res, $key);
                //$cached = false;
            //}
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res);
        $json = json_encode($arr);
        return new Response($json);
        
    }
}