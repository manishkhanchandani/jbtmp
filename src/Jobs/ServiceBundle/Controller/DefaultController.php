<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Pagination\Paginator;


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
            $zipcode = $request->query->get('zipcode');
            $q = $request->query->get('q');
            $extension = '';
            if (!empty($q)) {
                $extension .= " AND k.keyword LIKE '%$q%'";
            }
            /*$distance = ", (ROUND(
DEGREES(ACOS(SIN(RADIANS(“.GetSQLValueString($lat, 'double').”)) * SIN(RADIANS(c.lat)) + COS(RADIANS(“.GetSQLValueString($lat, 'double').”)) * COS(RADIANS(c.lat)) * COS(RADIANS(“.GetSQLValueString($lon, 'double').” -(c.lon)))))*60*1.1515,2)) as distance";*/
            if (!empty($zipcode)) {
                $distance = '';
                /*$sql = sprintf(“select city_id, url, city, state, country, lat, lon, (ROUND(
DEGREES(ACOS(SIN(RADIANS(“.GetSQLValueString($lat, 'double').”)) * SIN(RADIANS(c.lat)) + COS(RADIANS(“.GetSQLValueString($lat, 'double').”)) * COS(RADIANS(c.lat)) * COS(RADIANS(“.GetSQLValueString($lon, 'double').” -(c.lon)))))*60*1.1515,2)) as distance from c_cities as c WHERE (ROUND(
DEGREES(ACOS(SIN(RADIANS(“.GetSQLValueString($lat, 'double').”)) * SIN(RADIANS(c.lat)) + COS(RADIANS(“.GetSQLValueString($lat, 'double').”)) * COS(RADIANS(c.lat)) * COS(RADIANS(“.GetSQLValueString($lon, 'double').” -(c.lon)))))*60*1.1515,2)) <= “.GetSQLValueString($radius, 'int').” ORDER BY “.$order.” LIMIT “.$limit);*/
            }
            //$cache = $this->get('jobs_service.cachev1')->init();
            //$res = $cache->load($key);
            //if (empty($res)) {
                $res = array();
                $em = $this->getDoctrine()->getManager();
                $maxRows_rsView = 100;
                $pageNum_rsView = 0;
                if ($request->query->get('pageNum_rsView')) {
                    $pageNum_rsView = $request->query->get('pageNum_rsView');
                }
                if ($request->query->get('maxRows_rsView')) {
                    $maxRows_rsView = $request->query->get('maxRows_rsView');
                }
                $startRow_rsView = $pageNum_rsView * $maxRows_rsView;
                if (!$request->query->get('totalRows_rsView')) {
                    $query = $em->createQuery(
                        //'SELECT j from JobsServiceBundle:Jobs as j ORDER BY j.jobCreatedDt'
                        "SELECT count(j) as cnt from JobsServiceBundle:Jobs as j LEFT JOIN JobsServiceBundle:GeoCities as c WITH c.ctyId = j.city LEFT JOIN JobsServiceBundle:GeoCountries as co WITH co.conId = j.country  LEFT JOIN JobsServiceBundle:GeoStates as s WITH s.staId = j.state LEFT JOIN JobsServiceBundle:Users as u WITH u.userId = j.userId LEFT JOIN JobsServiceBundle:JobsKeywords as k WITH k.jobId = j.jobId WHERE 1 $extension ORDER BY j.jobModifiedDt ASC"
                    );
                    $res = $query->getOneOrNullResult();
                    $totalRows_rsView = $res['cnt'];
                } else {
                    $totalRows_rsView = $request->query->get('totalRows_rsView');
                }
                $totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;
                $queryString_rsView = '';
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $params = explode('&', $_SERVER['QUERY_STRING']);
                    $newParams = array();
                    foreach ($params as $param) {
                        if (stristr($param, 'pageNum_rsView') == false &&
                            stristr($param, 'totalRows_rsView') == false) {
                                array_push($newParams, $param);
                        }
                    }
                    if (count($newParams) != 0) {
                        $queryString_rsView = '&' . htmlentities(implode('&', $newParams));
                    }
                }
                $queryString_rsView = sprintf('&totalRows_rsView=%d%s', $totalRows_rsView, $queryString_rsView);
                $query = $em->createQuery(
                    //'SELECT j from JobsServiceBundle:Jobs as j ORDER BY j.jobCreatedDt'
                    'SELECT j.jobId, j.userId, j.title, u.firstname, u.lastname, j.number, c.name as city, s.name as state, co.name as country, c.latitude as latitude, c.longitude as longitude from JobsServiceBundle:Jobs as j LEFT JOIN JobsServiceBundle:GeoCities as c WITH c.ctyId = j.city LEFT JOIN JobsServiceBundle:GeoCountries as co WITH co.conId = j.country  LEFT JOIN JobsServiceBundle:GeoStates as s WITH s.staId = j.state LEFT JOIN JobsServiceBundle:Users as u WITH u.userId = j.userId ORDER BY j.jobModifiedDt ASC'
                );
                $query->setFirstResult( $startRow_rsView );
                $query->setMaxResults( $maxRows_rsView );
                $res = $query->getResult();
                //$cache->save($res, $key);
                //$cached = false;
            //}
            $result = 1;
            $arr = array('success' => $result, 
                'message' => $msg, 
                'code' => $code, 
                'data' => $res, 
                'totalRows_rsView' => $totalRows_rsView, 
                'queryString_rsView' => $queryString_rsView, 
                'totalPages_rsView' => $totalPages_rsView,
                'startRow_rsView' => $startRow_rsView,
                'maxRows_rsView' => $maxRows_rsView, 
                'pageNum_rsView' => $pageNum_rsView, 
                'first' => ($pageNum_rsView > 0) ? 0 : null,
                
                'previous' => ($pageNum_rsView > 0) ? max(0, $pageNum_rsView - 1) : null, 
                'next' => ($pageNum_rsView < $totalPages_rsView) ? min($totalPages_rsView, $pageNum_rsView + 1) : null, 
                'last' => ($pageNum_rsView < $totalPages_rsView) ? $totalPages_rsView : null
                );
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
            $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $res);
        }
        $json = json_encode($arr);
        return new Response($json);
        
    }
}