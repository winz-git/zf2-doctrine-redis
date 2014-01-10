<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            // Users
            'users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:action[/:id]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Users',
                        'action'     => 'index',
                    ),
                ),
            ),
            // Accounts
            'accounts' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/accounts[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' =>'Application\Controller\Accounts',
                        'action' => 'index',
                    )
                )
            ),
            // login route
            'auth' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/auth[/:action[/:extra[/:key]]]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'extra' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'key' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action'     => 'index',
                    )
                ),

            ),
            // ajax route
            'ajax' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/ajax',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ajax',
                        'action'     => 'index',
                    ),
                ),
            ),


            // static pages
            'static' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/static[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Pages',
                        'action'     => 'terms',
                    ),
                ),
            ),


        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Application\Cache\Redis' => 'Application\Service\Factory\RedisCacheFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Ajax' => 'Application\Controller\AjaxController',
            'Application\Controller\Pages' => 'Application\Controller\PagesController',
            'Application\Controller\Users' => 'Application\Controller\UsersController',
            'Application\Controller\Accounts' => 'Application\Controller\AccountsController',
        ),
    ),
    //
    'controller_plugins' => array(
        'invokables' => array(
            'StripePlugin' => 'Application\Plugin\StripePlugin'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
             __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    //
    'doctrine' => array(
        'orm_autoload_annotations' => true,

        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'event_manager' => 'orm_default',

                //params
                'doctrine_type_mappings' => array(
                    'enum' => 'string'
                ),
            )
        ),

        'configuration' => array(
            'orm_default' => array(
                'metadata_cache'    => 'redis',
                'query_cache'       => 'redis',
                'result_cache'      => 'redis',

                'driver'            => 'orm_default',


                'generate_proxies'  => false,
                'proxy_dir'         => array(__DIR__ .'/../data/DoctrineORMModule/Proxy'),
                'proxy_namespace'   => 'DoctrineProxies'
            )
        ),

        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'redis',
                'paths' => array(__DIR__ . '/../src/'. __NAMESPACE__ .'/Model/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Model\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),

        'entitymanager' => array(
            'orm_default' => array(
                'connection' => 'orm_default',
                'configuration'=> 'orm_default',
            )

        ),

        'eventmanager' => array(
            'orm_default' => array(),
        ),

        'entity_resolver' => array(
            'orm_default' => array()
        ),


        //Cache
        'cache' => array(
            'apc' => array(
                'class'     => 'Doctrine\Common\Cache\ApcCache',
                'namespace' => 'DoctrineModule',
            ),
            'array' => array(
                'class' => 'Doctrine\Common\Cache\ArrayCache',
                'namespace' => 'DoctrineModule',
            ),
            'filesystem' => array(
                'class'     => 'Doctrine\Common\Cache\FilesystemCache',
                'directory' => 'data/DoctrineModule/cache',
                'namespace' => 'DoctrineModule',
            ),
            'memcache' => array(
                'class'     => 'Doctrine\Common\Cache\MemcacheCache',
                'instance'  => 'my_memcache_alias',
                'namespace' => 'DoctrineModule',
            ),
            'memcached' => array(
                'class'     => 'Doctrine\Common\Cache\MemcachedCache',
                'instance'  => 'my_memcached_alias',
                'namespace' => 'DoctrineModule',
            ),
            'redis' => array(
                'class'     => 'Doctrine\Common\Cache\RedisCache',
                'instance'  => 'my_redis_alias',
                'namespace' => 'DoctrineModule',
            ),
            'wincache' => array(
                'class'     => 'Doctrine\Common\Cache\WinCacheCache',
                'namespace' => 'DoctrineModule',
            ),
            'xcache' => array(
                'class'     => 'Doctrine\Common\Cache\XcacheCache',
                'namespace' => 'DoctrineModule',
            ),
            'zenddata' => array(
                'class'     => 'Doctrine\Common\Cache\ZendDataCache',
                'namespace' => 'DoctrineModule',
            ),
        )
    ),
    //
    // Navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'controller'=>'Application\Controller\Index',
                'route' => 'home',
            ),
            array(
                'label' => 'Login',
                'controller'=>'Application\Controller\Auth',
                'route' => 'auth',
            ),
            //
            array(
                'label' => 'Users',
                'controller'=>'Application\Controller\Users',
                'route' => 'users',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'users',
                        'action' => 'add'
                    )
                )
            )
        )
    )


);
