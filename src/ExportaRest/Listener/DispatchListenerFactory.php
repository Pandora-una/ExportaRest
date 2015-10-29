<?php

namespace ExportaRest\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DispatchListenerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = $config['exporta_rest'];
        
        $csvTemplateDirName = $config['csv_template_dir_name'];
        $pdfTemplateDirName = $config['pdf_template_dir_name'];
        
        $listener = new DispatchListener($csvTemplateDirName,$pdfTemplateDirName);
        return $listener;
    }
}
