<?php

namespace ExportaRest\Csv;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExportaCsvRendererFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewManager = $serviceLocator->get('ViewManager');
        
        $csvRenderer = new ExportaCsvRenderer();
		$csvRenderer->setHelperPluginManager($serviceLocator->get('ViewHelperManager'));
        $csvRenderer->setResolver($viewManager->getResolver());        
        return $csvRenderer;
    }
}