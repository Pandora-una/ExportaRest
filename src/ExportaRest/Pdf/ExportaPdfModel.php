<?php
namespace Application\Pdf\View\Model;

use DOMPDFModule\View\Model\PdfModel;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Model\ViewModel;

class RelatorioPdfModel extends PdfModel
{
	public function setTerminal($terminate) {
		return $this;
	}
	public function setCaptureTo($capture) {
		return $this;
	}
	
	public function getTemplate() {
		return 'application/relatorio-pdf/'.$this->getCollection()->getCollectionName();
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