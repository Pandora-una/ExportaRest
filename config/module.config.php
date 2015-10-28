<?php
namespace ExportaRest;

return array(
		'listeners' => array(
				'ExportaRest\Listener\DispatchListener',
		),
		'view_manager' => array(
				'strategies' => array(
					'ExportaRest\Csv\CsvStrategy'
				)
		),
		'service_manager' => array(
			'invokables' => array(
				'ExportaRest\Pdf\DispatchListener'=>'ExportaRest\Pdf\DispatchListener',
				'ExportaRest\Csv\CsvRenderer'=>'ExportaRest\Csv\CsvRenderer'
			),
			'factories' => array(
				'ExportaRest\Csv\CsvStrategy' => 'ExportaRest\Csv\CsvStrategyFactory',
			)
		),
		'exporta_rest' => array(
			'csv_template_dir_name' => 'relatorio-csv',
			'pdf_template_dir_name' => 'relatorio-pdf'
		)		
);