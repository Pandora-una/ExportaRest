<?php
namespace ExportaRest\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class DispatchListener extends AbstractListenerAggregate
{
	
	public function attach(EventManagerInterface $events)
    {    	   
    	
    	$this->listeners[] = $events->getSharedManager()->attach('Zend\Stdlib\DispatchableInterface',
    												MvcEvent::EVENT_DISPATCH,array($this, 'onDispatch'),-9);    	
        
    }
    
    
    public function onDispatch(MvcEvent $e) {
    	$viewModel = $e->getResult();
    	if ($viewModel instanceof \ZF\ContentNegotiation\ViewModel) {
    		$paperOrientation = $e->getRequest()->getQuery('paper-orientation','portrait');
    		$viewModel->setOption('paperOrientation', $paperOrientation);
    		$e->setResult($viewModel);
    	}
    }
    
}
