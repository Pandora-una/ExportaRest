<?php
namespace ExportaRest;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface, DependencyIndicatorInterface
{

    public function getModuleDependencies()
    {
        return array('DOMPDFModule');
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
    
	
}