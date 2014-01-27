<?php
namespace Jobs\ServiceBundle\Models;


class DataProvider
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
        return $this;
    }

    public function getCityDetails($id)
    {
        echo $id;exit;
        //$em = $this->container->get('doctrine')->getManager();
        //pr($em);
    }
    
    public function getEntityManager() {
        return $this->container->get('doctrine')->getEntityManager();
    }
}