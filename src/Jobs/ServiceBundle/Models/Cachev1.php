<?php

namespace Jobs\ServiceBundle\Models;

use \Zend_Cache;

class Cachev1
{
    private $container;

    private $rootDir;

    private $ttl = 12000;

    public function __construct($container)
    {
        $this->container = $container;
        $this->rootDir = $this->container->getParameter('kernel.root_dir');
        return $this;
    }

    public function init()
    {
        
        $frontendOptions = array(
            'lifetime' => $this->ttl, // cache lifetime of 2 hours
            'automatic_serialization' => true
         );
        $backendOptions = array(
            'cache_dir' => $this->rootDir.'/cache' // Directory where to put the cache files
        );
        $cache = \Zend_Cache::factory('Core',
                             'File',
                             $frontendOptions,
                             $backendOptions);
        return $cache;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }
}