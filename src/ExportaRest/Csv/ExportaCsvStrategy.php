<?php

namespace Application\Csv;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\ViewEvent;
use DOMPDFModule\View\Model\CsvModel;


class CsvStrategy extends AbstractListenerAggregate
{

    /**
     * @var CsvRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  CsvRenderer $renderer
     * @return void
     */
    public function __construct(CsvRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @param  int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }


    /**
     * Detect if we should use the PdfRenderer based on model type
     *
     * @param  ViewEvent $e
     * @return null|PdfRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        
        if ($model instanceof CsvModel) {
            return $this->renderer;
        }

        return;
    }

    /**
     * Inject the response with the PDF payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $e->getResult();

        if (!is_string($result)) {
            return;
        }
        
        $response = $e->getResponse();
        $response->setContent($result);
        $response->getHeaders()->addHeaderLine('content-type', 'text/csv');
        
        $fileName = $e->getModel()->getOption('filename');
        if (isset($fileName)) {
            if (substr($fileName, -4) != '.csv') {
                $fileName .= '.csv';
            }
            
            $response->getHeaders()->addHeaderLine(
            	'Content-Disposition', 
            	'attachment; filename=' . $fileName);
        }
    }
}