<?php
namespace ExportaRest\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class DispatchListener extends AbstractListenerAggregate
{
	protected $csvTemplateDirName;

	protected $pdfTemplateDirName;
	
	
	public function __construct($csvTemplateDirName,$pdfTemplateDirName) {
		$this->csvTemplateDirName = $csvTemplateDirName;
		$this->pdfTemplateDirName = $pdfTemplateDirName;
		
	}
	
	public function attach(EventManagerInterface $events)
    {    	   
    	
    	$this->listeners[] = $events->getSharedManager()->attach('Zend\Stdlib\DispatchableInterface',
    												MvcEvent::EVENT_DISPATCH,array($this, 'onDispatch'),-11);    	
        
    }
    
    protected function getNamespace(\Zend\Mvc\Router\Http\RouteMatch $routeMatch) {
    	$controllerName = $routeMatch->getParam('controller');
    	$namespace = explode('\\',$controllerName);
    	return $namespace[0];
    }
    
    public function onDispatch(MvcEvent $e) {
    	$viewModel = $e->getResult();
    	$namespace = $this->getNamespace($e->getRouteMatch());
    	if ($viewModel instanceof \ExportaRest\Csv\ExportaCsvModel) {
    		$viewModel->setTemplateDir($namespace.'/'.$this->csvTemplateDirName);
			$viewModel->setOption('filename',$e->getRequest()->getQuery('filename','relatorio'));  
			$e->setResult($viewModel);
    	} 
    	   
    	if ($viewModel instanceof \ExportaRest\Pdf\ExportaPdfModel) {
    		$viewModel->setTemplateDir($namespace.'/'.$this->pdfTemplateDirName);
    		$viewModel->setOption('paperOrientation', $e->getRequest()->getQuery('paper-orientation','portrait'));
    		$viewModel->setOption('filename',$e->getRequest()->getQuery('filename','relatorio'));
    		$e->setResult($viewModel);
    	} 
    }
    
}
