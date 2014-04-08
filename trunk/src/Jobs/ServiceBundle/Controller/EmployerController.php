<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Jobs;
use Jobs\ServiceBundle\Entity\JobsPositionType;
use Jobs\ServiceBundle\Entity\JobsKeywords;

class EmployerController extends MainController
{
    /*
     * [apply] => email
    [status] => 0
    [title] => test123
    [number] => 123
    [expiryDate] => 26/03/2014
    [position] => Array
        (
            [0] => 1
        )

    [email] => mkgxy@mkgalaxy.com
    [country] => 223
    [state] => 3469
    [city] => 143877
    [areaCode] => 22
    [postalCode] => 22
    [skills] => 22
    [description] => 222
    [contact_zip] => true
     */
    public function postAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            if (!$request->request->get('number')) {
                throw new \Exception('Job Number is Empty');
            }
            if (!$request->request->get('title')) {
                throw new \Exception('Job Title is Empty');
            }
            $jobId = guid();
            $created = tstobts(time());
            $jobs = new Jobs();
            $jobs->setJobId($jobId);
            $jobs->setUserId($this->userId);
            $jobs->setTitle($request->request->get('title'));
            $jobs->setApplicationMethod($request->request->get('apply'));
            $jobs->setApplicationEmail($request->request->get('email'));
            $jobs->setApplicationEmailCc($request->request->get('CCemail'));
            $jobs->setApplicationUrl($request->request->get('url'));
            $city = $request->request->get('city');
            $emGet = $this->getDoctrine()->getManager();
            $query = $emGet->createQuery(
                    'SELECT c from JobsServiceBundle:GeoCities as c WHERE c.ctyId = ?1'
                );
            $query->setParameter(1, $city);
            $dataCity = $query->getResult();
            //$cityName = isset($city['name']) ? $city['name'] : $city;
            $jobs->setCity($city);
            //$cityId = isset($city['id']) ? $city['id'] : null;
            //$jobs->setCityId($cityId);
            $state = $request->request->get('state');
            //$stateId = isset($state['name']) ? $state['name'] : null;
            $jobs->setState($state);
            $country = $request->request->get('country');
            //$countryId = isset($country['name']) ? $country['name'] : null;
            $jobs->setCountry($country);
            $jobs->setNumber($request->request->get('number'));
            $jobs->setAreaCode($request->request->get('areaCode'));
            $jobs->setZipcode($request->request->get('postalCode'));
            $jobs->setDescription($request->request->get('description'));
            $jobs->setShowName($this->setCheckbox($request->request->get('contact_name')));
            $jobs->setShowAddress1($this->setCheckbox($request->request->get('contact_address1')));
            $jobs->setShowAddress2($this->setCheckbox($request->request->get('contact_address2')));
            $jobs->setShowCity($this->setCheckbox($request->request->get('contact_city')));
            $jobs->setShowState($this->setCheckbox($request->request->get('contact_state')));
            $jobs->setShowEmail($this->setCheckbox($request->request->get('contact_email')));
            $jobs->setShowPhone($this->setCheckbox($request->request->get('contact_phone')));
            $jobs->setShowZipcode($this->setCheckbox($request->request->get('contact_zip')));
            
            $latitude = ($dataCity[0]->getLatitude()) ? $dataCity[0]->getLatitude() : null;
            $longitude = ($dataCity[0]->getLongitude()) ? $dataCity[0]->getLongitude() : null;
            $jobs->setLatitude($latitude);
            $jobs->setLongitude($longitude);
            $jobs->setJobCreatedDt($created);
            $jobs->setJobDeleted(0);
            $jobs->setJobDeletedDt(0);
            $jobs->setJobModifiedDt($created);
            $status = $request->request->get('status');
            $jobs->setJobStatus($status);
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobs);
            $position = $request->request->get('position');
            if (!empty($position)) {
                $counter = 0;
                foreach ($position as $type) {
                    $JobsPositionType[$counter] = new JobsPositionType();
                    $JobsPositionType[$counter]->setJobId($jobId);
                    $JobsPositionType[$counter]->setPositionType($type);
                    $em->persist($JobsPositionType[$counter]);
                    $counter++;
                }
            }
            $skills = $request->request->get('skills');
            $skills = trim($skills);
            if (!empty($skills)) {
                $counter = 0;
                $skill = explode(',', $skills);
                foreach ($skill as $keyword) {
                    $JobsKeywords[$counter] = new JobsKeywords();
                    $JobsKeywords[$counter]->setJobId($jobId);
                    $JobsKeywords[$counter]->setKeyword(trim($keyword));
                    $em->persist($JobsKeywords[$counter]);
                    $counter++;
                }
            }
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

    
    public function updateAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $jobId = $request->query->get('jobId');
            if (empty($jobId)) {
                throw new \Exception('Job Id not found in url.');
            }
            if (!$request->request->get('number')) {
                throw new \Exception('Job Number is Empty');
            }
            if (!$request->request->get('title')) {
                throw new \Exception('Job Title is Empty');
            }
            $created = tstobts(time());
            $em = $this->getDoctrine()->getManager();
            $jobs = $em->getRepository('JobsServiceBundle:Jobs')->find($jobId);

            if (!$jobs) {
                throw new \Exception('No Job Found.');
            }
            //$jobs->setJobId($jobId);
            $jobs->setUserId($this->userId);
            $jobs->setTitle($request->request->get('title'));
            $position = $request->request->get('position');
            $position_type = isset($position[0]) ? $position[0] : null;
            $jobs->setPositionType($position_type);
            $jobs->setNumber($request->request->get('number'));
            $jobs->setApplicationMethod($request->request->get('apply'));
            $jobs->setApplicationEmail($request->request->get('email'));
            $jobs->setApplicationEmailCc($request->request->get('CCemail'));
            $jobs->setApplicationUrl($request->request->get('url'));
            $city = $request->request->get('city');
            $emGet = $this->getDoctrine()->getManager();
            $query = $emGet->createQuery(
                    'SELECT c from JobsServiceBundle:GeoCities as c WHERE c.ctyId = ?1'
                );
            $query->setParameter(1, $city);
            $dataCity = $query->getResult();
            //$cityName = isset($city['name']) ? $city['name'] : $city;
            $jobs->setCity($city);
            //$cityId = isset($city['id']) ? $city['id'] : null;
            //$jobs->setCityId($cityId);
            $state = $request->request->get('state');
            //$stateId = isset($state['name']) ? $state['name'] : null;
            $jobs->setState($state);
            $country = $request->request->get('country');
            //$countryId = isset($country['name']) ? $country['name'] : null;
            $jobs->setCountry($country);
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
            $latitude = ($dataCity[0]->getLatitude()) ? $dataCity[0]->getLatitude() : null;
            $longitude = ($dataCity[0]->getLongitude()) ? $dataCity[0]->getLongitude() : null;
            $jobs->setLatitude($latitude);
            $jobs->setLongitude($longitude);
            //$jobs->setJobCreatedDt($created);
            //$jobs->setJobDeleted(0);
            //$jobs->setJobDeletedDt(0);
            $jobs->setJobModifiedDt($created);
                //$jobs->setJobStatus(1);
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

    
    public function activeAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $statusTxt = $request->request->get('status');
            //$status = array('jobId' => status, 'jobid2' => status);
            if (empty($statusTxt)) {
                throw new \Exception('Status not found.');
            }
            $status = explode(',', $statusTxt);
            $created = tstobts(time());
            $em = $this->getDoctrine()->getManager();
            $value = 1;
            foreach ($status as $jobId) {
                $jobId = trim($jobId);
                $jobs = $em->getRepository('JobsServiceBundle:Jobs')->find($jobId);
                $jobs->setJobStatus($value);
                $em->flush();
            }
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
    
    
    public function inactiveAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $statusTxt = $request->request->get('status');
            //$status = array('jobId' => status, 'jobid2' => status);
            if (empty($statusTxt)) {
                throw new \Exception('Status not found.');
            }
            $status = explode(',', $statusTxt);
            $created = tstobts(time());
            $em = $this->getDoctrine()->getManager();
            $value = 0;
            foreach ($status as $jobId) {
                $jobId = trim($jobId);
                $jobs = $em->getRepository('JobsServiceBundle:Jobs')->find($jobId);
                $jobs->setJobStatus($value);
                $em->flush();
            }
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
    
    
    public function statuschangeAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $status = $request->request->get('status');
            //$status = array('jobId' => status, 'jobid2' => status);
            if (empty($status)) {
                throw new \Exception('Status not found.');
            }
            $created = tstobts(time());
            $em = $this->getDoctrine()->getManager();
            foreach ($status as $jobId => $value) {
                $jobs = $em->getRepository('JobsServiceBundle:Jobs')->find($jobId);
                $jobs->setJobStatus($value);
                $em->flush();
            }
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
    
    
    
    public function deleteAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $deleteTxt = $request->request->get('status');
            //$delete = array('jobId', 'jobid2');
            if (empty($deleteTxt)) {
                throw new \Exception('JobIds not found.');
            }
            $delete = explode(',', $deleteTxt);
            $em = $this->getDoctrine()->getManager();
            foreach ($delete as $jobId) {
                $jobId = trim($jobId);
                $jobs = $em->getRepository('JobsServiceBundle:Jobs')->find($jobId);
                $em->remove($jobs);
                $em->flush();
            }
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
                        //$res[$v->getName()] = $v->getConId();
                        $res[$k]['job_id'] = $v->getJobId();
                        $res[$k]['user_id'] = $v->getUserId();
                        $res[$k]['title'] = $v->getTitle();
                        $res[$k]['number'] = $v->getNumber();
                        $res[$k]['position_type'] = $v->getPositionType();
                        $res[$k]['city'] = $v->getCity();
                        $res[$k]['state'] = $v->getState();
                        $res[$k]['country'] = $v->getCountry();
                        $res[$k]['area_code'] = $v->getAreaCode();
                        $res[$k]['zip_code'] = $v->getZipcode();
                        $res[$k]['skills'] = $v->getSkills();
                        $res[$k]['description'] = $v->getDescription();
                        $res[$k]['application_method'] = $v->getApplicationMethod();
                        $res[$k]['application_email'] = $v->getApplicationEmail();
                        $res[$k]['application_email_cc'] = $v->getApplicationEmailCc();
                        $res[$k]['application_url'] = $v->getApplicationUrl();
                        $res[$k]['show_name'] = $v->getShowName();
                        $res[$k]['show_address1'] = $v->getShowAddress1();
                        $res[$k]['show_address2'] = $v->getShowAddress2();
                        $res[$k]['get_show_city'] = $v->getShowCity();
                        $res[$k]['show_zipcode'] = $v->getShowZipcode();
                        $res[$k]['show_phone'] = $v->getShowPhone();
                        $res[$k]['show_email'] = $v->getShowEmail();
                        $res[$k]['job_created_dt'] = date('Y-m-d', btstots($v->getJobCreatedDt()));
                        $res[$k]['job_modified_dt'] = date('Y-m-d', $v->getJobModifiedDt());
                        $res[$k]['job_deleted_dt'] = date('Y-m-d', $v->getJobDeletedDt());
                        $res[$k]['job_deleted'] = $v->getJobDeleted();
                        $res[$k]['job_status'] = $v->getJobStatus();
                        $res[$k]['show_state'] = $v->getShowState();
                        $res[$k]['latitude'] = $v->getLatitude();
                        $res[$k]['longitude'] = $v->getLongitude();
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
    
    
    public function previewAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            //$this->init($request);
            $jobId = $request->query->get('jobId');
            if (empty($jobId)) {
                throw new \Exception('Job Id not found in url.');
            }
            $key = 'countries';
            //$cache = $this->get('jobs_service.cachev1')->init();
            //$res = $cache->load($key);
            //if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT j, c, co, s, u from JobsServiceBundle:Jobs as j LEFT JOIN JobsServiceBundle:GeoCities as c WITH c.ctyId = j.city LEFT JOIN JobsServiceBundle:GeoCountries as co WITH co.conId = j.country  LEFT JOIN JobsServiceBundle:GeoStates as s WITH s.staId = j.state LEFT JOIN JobsServiceBundle:Users as u WITH u.userId = j.userId WHERE j.jobId = ?1 ORDER BY j.jobCreatedDt'
                );
                $query->setParameter(1, $jobId);

                $data = $query->getResult();
                if (!empty($data)) {
                        $k = 0;
                        $v = $data[$k];
                        //$res[$v->getName()] = $v->getConId();
                        $res[$k]['job_id'] = $v->getJobId();
                        $res[$k]['user_id'] = $v->getUserId();
                        $res[$k]['title'] = $v->getTitle();
                        $res[$k]['number'] = $v->getNumber();
                        $res[$k]['position_type'] = $v->getPositionType();
                        $res[$k]['cityId'] = $v->getCity();
                        $res[$k]['stateId'] = $v->getState();
                        $res[$k]['countryId'] = $v->getCountry();
                        $res[$k]['area_code'] = $v->getAreaCode();
                        $res[$k]['zip_code'] = $v->getZipcode();
                        $res[$k]['skills'] = $v->getSkills();
                        $res[$k]['description'] = $v->getDescription();
                        $res[$k]['application_method'] = $v->getApplicationMethod();
                        $res[$k]['application_email'] = $v->getApplicationEmail();
                        $res[$k]['application_email_cc'] = $v->getApplicationEmailCc();
                        $res[$k]['application_url'] = $v->getApplicationUrl();
                        $res[$k]['show_name'] = $v->getShowName();
                        $res[$k]['show_address1'] = $v->getShowAddress1();
                        $res[$k]['show_address2'] = $v->getShowAddress2();
                        $res[$k]['get_show_city'] = $v->getShowCity();
                        $res[$k]['show_zipcode'] = $v->getShowZipcode();
                        $res[$k]['show_phone'] = $v->getShowPhone();
                        $res[$k]['show_email'] = $v->getShowEmail();
                        $res[$k]['job_created_dt'] = $v->getJobCreatedDt();
                        $res[$k]['job_modified_dt'] = $v->getJobModifiedDt();
                        $res[$k]['modified'] = date('Y-m-d', btstots($res[$k]['job_created_dt']));
                        $res[$k]['created'] = date('Y-m-d', btstots($res[$k]['job_modified_dt']));
                        $res[$k]['job_deleted_dt'] = $v->getJobDeletedDt();
                        $res[$k]['job_deleted'] = $v->getJobDeleted();
                        $res[$k]['job_status'] = $v->getJobStatus();
                        $res[$k]['show_state'] = $v->getShowState();
                        $res[$k]['latitude'] = $v->getLatitude();
                        $res[$k]['longitude'] = $v->getLongitude();
                        $k = 1;
                        $v = $data[$k];
                        $res[0]['city'] = $v->getName();
                        $k = 2;
                        $v = $data[$k];
                        $res[0]['country'] = $v->getName();
                        $k = 3;
                        $v = $data[$k];
                        $res[0]['state'] = $v->getName();
                        $k = 4;
                        $v = $data[$k];
                        $res[0]['user']['firstname'] = $v->getFirstname();
                        $res[0]['user']['lastname'] = $v->getLastname();
                        $res[0]['user']['name'] = $v->getFirstname().' '.$v->getLastname();
                        $res[0]['user']['address'] = $v->getAddress();
                        $res[0]['user']['address2'] = $v->getAddress2();
                        $res[0]['user']['country'] = $v->getCountry();
                        $res[0]['user']['city'] = $v->getCity();
                        $res[0]['user']['state'] = $v->getState();
                        $res[0]['user']['zip'] = $v->getZip();
                        $res[0]['user']['phone'] = $v->getPhone();
                        $res[0]['user']['email'] = $v->getEmail();
                }
                $res = array_pop($res);
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