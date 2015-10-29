<?php

namespace ExportaRest\Csv;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ExportaCsvStrategyFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $csvRenderer = $serviceLocator->get('ExportaRest\Csv\ExportaCsvRenderer');
        $csvStrategy = new ExportaCsvStrategy($csvRenderer);
        return $csvStrategy;
    }
}
