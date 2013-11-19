<?php
/**
 *
 * User: winston.c
 * Date: 08/11/13
 * Time: 11:41 AM
 * 
 */

namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Cache\ZendStorageCache;

class DoctrineRedisCacheFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $redis_cache = $serviceLocator->get('Application\Cache\Redis');

        $doctrine_cache = new ZendStorageCache($redis_cache);

        return $doctrine_cache;
    }
}