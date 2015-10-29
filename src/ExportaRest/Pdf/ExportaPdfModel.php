<?php
namespace ExportaRest\Pdf;

use DOMPDFModule\View\Model\PdfModel;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Model\ViewModel;

class ExportaPdfModel extends PdfModel
{
	
	protected $templateDir;
	
	public function setTerminal($terminate) {
		return $this;
	}
	public function setCaptureTo($capture) {
		return $this;
	}
	
	


	public function getTemplate() {
		return strtolower($this->templateDir) .'/'.$this->getCollection()->getCollectionName();
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

	public function getTemplateDir() {
		return $this->templateDir;
	}
	
	public function setTemplateDir($templateDir) {
		$this->templateDir = $templateDir;
		return $this;
	}
	
}