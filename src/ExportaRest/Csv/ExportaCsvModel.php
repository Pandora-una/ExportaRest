<?php

namespace ExportaCsv\Csv;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\ArrayUtils;

class CsvModel extends ViewModel
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
    
    public function setTerminal($terminate)
    {
    	return $this;
    }
    
    public function setTemplate($template)
    {
    	return $this;
    }
    
    
    public function getTemplate() {
    	return 'application/relatorio-csv/'.$this->getCollection()->getCollectionName();
    }
    
    /**
     * @return \ZF\Hal\Collection
     */
    protected function getCollection() {
    	$variables = $this->getVariables();
    	if ($variables instanceof Traversable) {
    		$variables = ArrayUtils::iteratorToArray($variables);
    	}
    	return $variables['payload'];
    }
    
}