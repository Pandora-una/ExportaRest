<?php
namespace ExportaRest;

return array(
		'listeners' => array(
				'ExportaRest\Listener\DispatchListener',
		),
		'view_manager' => array(
				'strategies' => array(
					'ExportaRest\Csv\ExportaCsvStrategy'
				)
		),
		'service_manager' => array(
			'factories' => array(
				'ExportaRest\Csv\ExportaCsvRenderer'=>'ExportaRest\Csv\ExportaCsvRendererFactory',
				'ExportaRest\Listener\DispatchListener'=>'ExportaRest\Listener\DispatchListenerFactory',		
				'ExportaRest\Csv\ExportaCsvStrategy' => 'ExportaRest\Csv\ExportaCsvStrategyFactory',
			)
		),
		'exporta_rest' => array(
			'csv_template_dir_name' => 'relatorio-csv',
			'pdf_template_dir_name' => 'relatorio-pdf'
		),
		'zf-content-negotiation' => array(
			'selectors' => array(
				'HalJsonExportacao' => array(
					'ZF\Hal\View\HalJsonModel' => array(
						'application/json',
						'application/*+json',
					),
					'ExportaRest\Pdf\ExportaPdfModel' => array(
						'application/pdf'
					),
					'ExportaRest\Csv\ExportaCsvModel' => array(
						'text/csv'
					),	
				),
			),
		),
);