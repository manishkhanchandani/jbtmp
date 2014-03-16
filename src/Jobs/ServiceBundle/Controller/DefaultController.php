<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Jobs;


class DefaultController extends MainController
{
    public function indexAction($name)
    {
        try {
        $params = array('name' => 'manish khanchandani', 'to' => 'naveenkhanchandani@gmail.com', 'from' => 'cintel.jobs@gmail.com', 'subject' => 'Sub');
        $this->get('jobs_service.email')->send('add.html.php', $params);
        echo 'done';
        } catch(\Exception $e) {
            
        }
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
    
    public function varsAction()
    {
        return $this->render('JobsServiceBundle:Default:vars.html.php');
    }
    
    public function homeAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $key = 'home';
            //$cache = $this->get('jobs_service.cachev1')->init();
            //$res = $cache->load($key);
            //if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT j from JobsServiceBundle:Jobs as j ORDER BY j.jobCreatedDt'
                );

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
            $result = 1;
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
