<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Jobs;
use Jobs\ServiceBundle\Entity\JobsRepository;
use Jobs\ServiceBundle\Models\ErrorCode;

class EmployerController extends MainController
{
    
    public function postAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $jobId = guid();
            $created = tstobts(time());
            $jobs = new Jobs();
            $jobs->setJobId($jobId);
            $jobs->setUserId($this->userId);
            $jobs->setTitle($request->request->get('title'));
            $position = $request->request->get('position');
            $position_type = $position[0]['id'];
            $jobs->setPositionType($position_type);
            $jobs->setApplicationMethod($request->request->get('apply'));
            $jobs->setApplicationEmail($request->request->get('email'));
            $jobs->setApplicationEmailCc($request->request->get('CCemail'));
            $jobs->setApplicationUrl($request->request->get('url'));
            $city = $request->request->get('city');
            $city = isset($city['name']) ? $city['name'] : null;
            $jobs->setCity($city);
            $cityId = isset($city['id']) ? $city['id'] : null;
            $jobs->setCityId($cityId);
            $state = $request->request->get('state');
            $stateId = isset($state['name']) ? $state['name'] : null;
            $jobs->setState($stateId);
            $country = $request->request->get('country');
            $countryId = isset($country['name']) ? $country['name'] : null;
            $jobs->setCountry($countryId);
            $jobs->setAreaCode($request->request->get('areaCode'));
            $jobs->setZipcode($request->request->get('postalCode'));
            $jobs->setSkills($request->request->get('skills'));
            $jobs->setDescription($request->request->get('description'));
            $jobs->setShowName($this->setCheckbox($request->request->get('contact_name')));
            $jobs->setShowAddress1($this->setCheckbox($request->request->get('contact_address1')));
            $jobs->setShowAddress2($this->setCheckbox($request->request->get('contact_address2')));
            $jobs->setShowCity($this->setCheckbox($request->request->get('contact_city')));
            $jobs->setShowState($this->setCheckbox($request->request->get('contact_state')));
            $jobs->setShowEmail($this->setCheckbox($request->request->get('contact_email')));
            $jobs->setShowPhone($this->setCheckbox($request->request->get('contact_phone')));
            $jobs->setShowZipcode($this->setCheckbox($request->request->get('contact_zip')));
            $latitude = isset($city['latitude']) ? $city['latitude'] : null;
            $longitude = isset($city['longitude']) ? $city['longitude'] : null;
            $jobs->setLatitude($latitude);
            $jobs->setLongitude($longitude);
            $jobs->setJobCreatedDt($created);
            $jobs->setJobDeleted(0);
            $jobs->setJobDeletedDt(0);
            $jobs->setJobModifiedDt($created);
            $jobs->setJobStatus(1);
            pr($jobs);
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobs);
            $em->flush();
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'post' => $_POST);
        $json = json_encode($arr);
        return new Response($json);
    }

    
    public function jobsAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $this->init($request);
            $key = 'countries';
            //$cache = $this->get('jobs_service.cachev1')->init();
            //$res = $cache->load($key);
            //if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT j from JobsServiceBundle:Jobs as j WHERE j.userId = ?1 ORDER BY j.jobCreatedDt'
                );
                $query->setParameter(1, $this->userId);

                $data = $query->getResult();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        pr($v);
                        //$res[$v->getName()] = $v->getConId();
                        $res[$k]['job_id'] = $v->getJobId();
                        $res[$k]['user_id'] = $v->getUserId();
                        $res[$k]['title'] = $v->getTitle();
                        $res[$k]['position_type'] = $v->getPositionType();
                    }
                }
                pr($res);
                exit;
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