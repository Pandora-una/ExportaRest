# ExportaRest


		
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Api\DoacaoRpc\Controller' => 'HalJson',
        	'Api\Doacao\Controller' => array(
        			'ZF\Hal\View\HalJsonModel' => array(
        					'application/json',
        					'application/*+json',
        			),
        			'Application\Pdf\View\Model\RelatorioPdfModel' => array(
        					'application/pdf'
        			),       			 
        			'Application\Csv\CsvModel' => array(
        					'text/csv'
        			),
        			 
        	)
        ),
        'content_type_whitelist' => array(
            'Api\DoacaoRpc\Controller' => array('application/json'),
        	'Api\Doacao\Controller' => array('application/json'),
        ),
    ),
