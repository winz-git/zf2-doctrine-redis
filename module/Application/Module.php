<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Service\CacheFactory;
use DoctrineModule\Service\ZendStorageCacheFactory;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $serviceManager      = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $em = $serviceManager->get('Doctrine\ORM\EntityManager');
        $platform = $em->getConnection()->getDatabasePlatform();

        //Mapping
        $platform->registerDoctrineTypeMapping('enum', 'string');
        $platform->registerDoctrineTypeMapping('set', 'string');
        $platform->registerDoctrineTypeMapping('varbinary', 'string');
        $platform->registerDoctrineTypeMapping('tinyblob', 'text');

        //set timezone
        date_default_timezone_set('Asia/Hong_Kong');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getFormElementConfig()
    {
        return array(
            'invokables' => array(
                'LoginForm' => 'Application\Form\LoginForm',
            ),
            'initializers' => array(
                'ObjectManagerInitializer' => function ($element, $formElements) {
                    if ($element instanceof ObjectManagerAwareInterface) {
                        $services      = $formElements->getServiceLocator();
                        $entityManager = $services->get('Doctrine\ORM\EntityManager');

                        $element->setObjectManager($entityManager);
                    }
                },
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'doctrine.cache.redis' => 'Application\Service\Factory\DoctrineRedisCacheFactory',

                'DoctrineORMModule\Form\Annotation\AnnotationBuilder' => function(ServiceLocatorInterface $sl) {
                    return new AnnotationBuilder($sl->get('doctrine.entitymanager.orm_default'));
                },
            )
        );
    }
}
