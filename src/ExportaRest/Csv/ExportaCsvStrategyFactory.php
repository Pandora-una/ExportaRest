<?php

namespace Application\Csv;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CsvStrategyFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $csvRenderer = $serviceLocator->get('Application\Csv\CsvRenderer');
        $csvStrategy = new CsvStrategy($csvRenderer);
        return $csvStrategy;
    }
}
