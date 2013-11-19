<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 1:02 PM
 * 
 */

namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Cache\Storage\Adapter\RedisOptions;
use Zend\Cache\Storage\Adapter\Redis;

class RedisCacheFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /**
         * This fetches the configuration array we created above
         */
        $config = $serviceLocator->get('Config');
        $config = $config['redis'];

        /**
         * The configuration options are encapsulated in a class called RedisOptions
         * Here we setup the server configuration using the values from our config file
         */
        $redis_options = new RedisOptions();
        $redis_options->setServer(array(
            'host' => $config["host"],
            'port' => $config["port"],
            'timeout' => '30'
        ));

        /**
         * This is not required, although it will allow to store anything that can be serialized by PHP in Redis
         */
        $redis_options->setLibOptions(array(
            \Redis::OPT_SERIALIZER => \Redis::SERIALIZER_PHP
        ));

        /**
         * We create the cache passing the RedisOptions instance we just created
         */
        $redis_cache = new Redis($redis_options);

        return $redis_cache;
    }
}