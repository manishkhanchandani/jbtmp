<?php

namespace Jobs\ServiceBundle\Models;

use Zend\Cache\StorageFactory;

class Cache
{
    private $container;

    private $rootDir;

    private $ttl = 3600;

    private $nameSpace = 'default';

    public function __construct($container)
    {
        $this->container = $container;
        $this->rootDir = $this->container->getParameter('kernel.root_dir');
        return $this;
    }

    public function load()
    {
        $cache = StorageFactory::factory(array(
            'adapter' => array(
                'name' => 'filesystem',
                'options' => array(
                    'namespace' => $this->nameSpace,
                    'cache_dir' => $this->rootDir.'/cache',
                    'dir_level' => 2,
                    'ttl' => $this->ttl
                )
            ),
            'plugins' => array(
                // Don't throw exceptions on cache errors
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
                // We store database rows on filesystem so we need to serialize them
                'Serializer'
            )
        ));
        return $cache;
    }

    public function setNameSpace($namespace)
    {
        $this->nameSpace = $namespace;
        return $this;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }
}