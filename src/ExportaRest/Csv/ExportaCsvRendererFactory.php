<?php

namespace ExportaRest\Csv;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExportaCsvRendererFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewManager = $serviceLocator->get('ViewManager');
        $resolver = $serviceLocator->get('ViewResolver');
        
        $csvRenderer = new ExportaCsvRenderer();
		$csvRenderer->setHelperPluginManager($serviceLocator->get('ViewHelperManager'));
        $csvRenderer->setResolver($resolver);        
        return $csvRenderer;
    }
}
