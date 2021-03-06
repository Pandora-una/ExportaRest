<?php

namespace ExportaRest\Csv;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\ArrayUtils;

class ExportaCsvModel extends ViewModel
{

    
    /**
     * CSV probably won't need to be captured into a 
     * a parent container by default.
     * 
     * @var string
     */
    protected $captureTo = null;

    /**
     * CSV is usually terminal
     * 
     * @var bool
     */
    protected $terminate = true;
    
    protected $templateDir;
    

    
    
    public function setTerminal($terminate)
    {
    	return $this;
    }
    
    public function setTemplate($template)
    {
    	return $this;
    }
    
	public function getTemplate() {
	    if ($this->getPayload() instanceof \ZF\Hal\Entity) {
	        $reflection = new \ReflectionClass($this->getPayload()->entity);
	        $name = strtolower($reflection->getShortName()).'-entity';
	    } else 
	        $name = $this->getPayload()->getCollectionName();
	    
		return strtolower($this->templateDir) .'/'.$name;
	}    
    
    /**
     * @return \ZF\Hal\Collection
     */
    protected function getPayload() {
    	$variables = $this->getVariables();
    	if ($variables instanceof Traversable) {
    		$variables = ArrayUtils::iteratorToArray($variables);
    	}
    	return $variables['payload'];
    }
    
	public function getTemplateDir() {
		return $this->templateDir;
	}
	
	public function setTemplateDir($templateDir) {
		$this->templateDir = $templateDir;
		return $this;
	}
	
    
}