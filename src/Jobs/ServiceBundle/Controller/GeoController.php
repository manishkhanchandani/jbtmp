<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jobs\ServiceBundle\Entity\GeoCountries;
use Jobs\ServiceBundle\Entity\GeoCountriesRepository;

class GeoController extends MainController
{
    /*
     * Get country list 
     * http://jobs.mkgalaxy.com/app_dev.php/api/geo/countries
     */
    public function countryAction()
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $key = 'countries';
            $cache = $this->get('jobs_service.cachev1')->init();
            $res = $cache->load($key);
            if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT c from JobsServiceBundle:GeoCountries as c WHERE c.conId = 223 ORDER BY c.name'
                );

                $data = $query->getResult();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        //$res[$v->getName()] = $v->getConId();
                        $res[$k]['name'] = $v->getName();
                        $res[$k]['id'] = $v->getConId();
                    }
                }
                $cache->save($res, $key);
                $cached = false;
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res, 'cache' => $cached);
        $json = json_encode($arr);
        return new Response($json);
        
    }
    
    /*
     * Get state list based on country
     * http://jobs.mkgalaxy.com/app_dev.php/api/geo/states?id=1
     */
    public function stateAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $id = $request->query->get('id');
            if (empty($id)) throw new \Exception('Please choose country', 1112);
            $key = 'state_'.$id;
            $cache = $this->get('jobs_service.cachev1')->init();
            $res = $cache->load($key);
            if (empty($res)) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT s from JobsServiceBundle:GeoStates as s WHERE s.conId = :id ORDER BY s.name'
                )->setParameter('id', $id);

                $data = $query->getResult();
                //$repository = $this->getDoctrine()->getRepository('JobsServiceBundle:GeoCountries');
                //$data = $repository->findAll();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        $res[$k]['name'] = $v->getName();
                        $res[$k]['id'] = $v->getStaId();
                        $res[$k]['con_id'] = $v->getConId();
                    }
                }
                $cache->save($res, $key);
                $cached = false;
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res, 'cache' => $cached);
        $json = json_encode($arr);
        return new Response($json);
        
    }
    
    
    
    /*
     * Get state list based on country
     * http://jobs.mkgalaxy.com/app_dev.php/api/geo/cities?id=3469
     */
    public function cityAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $id = $request->query->get('id');
            if (empty($id)) throw new \Exception('Please choose state', 1113);
            $key = 'citys_'.$id;
            $cache = $this->get('jobs_service.cachev1')->init();
            $res = $cache->load($key);
            if (empty($res)) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT c from JobsServiceBundle:GeoCities as c WHERE c.staId = :id ORDER BY c.name'
                )->setParameter('id', $id);

                $data = $query->getResult();
                //$repository = $this->getDoctrine()->getRepository('JobsServiceBundle:GeoCountries');
                //$data = $repository->findAll();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        $res[$k]['name'] = $v->getName();
                        $res[$k]['id'] = $v->getCtyId();
                        $res[$k]['con_id'] = $v->getConId();
                        $res[$k]['sta_id'] = $v->getStaId();
                        $res[$k]['latitude'] = $v->getLatitude();
                        $res[$k]['longitude'] = $v->getLongitude();
                    }
                }
                $cache->save($res, $key);
                $cached = false;
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res, 'cache' => $cached);
        $json = json_encode($arr);
        return new Response($json);
        
    }
    
    
    /*
     * Get state list based on country
     * http://jobs.mkgalaxy.com/app_dev.php/api/geo/cities?id=3469
     */
    public function cityfAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        $data = array();
        $res = array();
        $cached = true;
        try {
            $id = $request->query->get('q');
            if (empty($id)) throw new \Exception('Please choose city', 1113);
            $key = 'cityfinder_'.md5($id);
            $cache = $this->get('jobs_service.cachev1')->init();
            $res = $cache->load($key);
            if (empty($res) || 1) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT c, co from JobsServiceBundle:GeoCities as c LEFT JOIN JobsServiceBundle:GeoCountries as co WITH co.conId = c.conId WHERE c.name like :id ORDER BY c.name'
                )->setParameter('id', '%'.$id.'%');

                $data = $query->getResult();
                pr($data);exit;
                //$repository = $this->getDoctrine()->getRepository('JobsServiceBundle:GeoCountries');
                //$data = $repository->findAll();
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        $res[$k]['name'] = $v->getName();
                        $res[$k]['id'] = $v->getCtyId();
                        $res[$k]['con_id'] = $v->getConId();
                        $res[$k]['sta_id'] = $v->getStaId();
                        $res[$k]['latitude'] = $v->getLatitude();
                        $res[$k]['longitude'] = $v->getLongitude();
                    }
                }
                $cache->save($res, $key);
                $cached = false;
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res, 'cache' => $cached);
        $json = json_encode($arr);
        return new Response($json);
        
    }
}