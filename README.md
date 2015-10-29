# ExportaRest

Biblioteca para gerar PDF e CSV a partir de uma requisição integrado ao Zend Framework 2 e Apigility

### Instalação

A forma recomendada de instalação é por [composer](https://getcomposer.org/):
```
    {
        "require": {
        	"pandora-una/exporta-rest" : "dev-master"
        }    
    }
```

Adicionar no application.config.php o módulo "ExportaRest"

### Configuração

```php
		'exporta_rest' => array(
			'csv_template_dir_name' => 'relatorio-csv',
			'pdf_template_dir_name' => 'relatorio-pdf'
		),
```

Para cada controller que for retornar um pdf ou um csv configurar:
```php
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Api\NomeDoController\Controller' => 'HalJsonExportacao'
        ),
```

Criar no módulo do controller os templates:

*	Api/view/api/relatorio-csv/nomeDaColecao.phtml
*	Api/view/api/relatorio-pdf/nomeDaColecao.phtml


Dentro de cada template usar a variável payload para pegar os dados da coleção. Ex:

CSV
```php
Cód;Data;Nome;CPF;Dt. Nascimento;Valor;Forma de Pagto;Status;Pagamento;Pago;Dt. Crédito;Valor Crédito;Status Transação;Recibo de doação
<?php foreach ($this->payload->getCollection() as $item):?>
<?php
$linha = $item->getId().';';
$linha .= $this->dateFormat($item->getDataHora(),IntlDateFormatter::MEDIUM).';';
$linha .= $item->getPessoa()->getNome().';';
$linha .= $this->cpfFormat($item->getPessoa()->getCpf()).';';
$linha .= $this->dateFormat($item->getPessoa()->getDtNascimento(),IntlDateFormatter::MEDIUM) .';';
$linha .= $this->currencyFormat($item->getValor(),'BRL').';';
$linha .= $item->getFormaPagamentoDescritivo().';';
$linha .= $item->getStatusDescritivo().';';
$linha .= $this->dateFormat($item->getDtPagamento(),IntlDateFormatter::MEDIUM).';';
$linha .= $this->currencyFormat($item->getValorPago(),'BRL').';';
$linha .= $this->dateFormat($item->getDtCredito(),IntlDateFormatter::MEDIUM).';';
$linha .= $this->currencyFormat($item->getValorCredito(),'BRL').';';
$linha .= ($item->getStatTran() ? $item->getStatTran()->getDescricao() : '').';';
$linha .= ($item->getRecibo() ? $item->getRecibo()->getNumeroReciboFormatado() : '').';';
echo $linha."\n";

endforeach;?>
```


PDF
```php
<html>
<body>
	<table>
		<thead>
			<tr>
				<td style="width: 30px">Cód</td>
				<td style="width: 40px">Data</td>
				<td style="width: 160px">Nome</td>
				<td style="width: 70px">CPF</td>
				<td style="width: 40px">Nasc</td>				
				<td style="width: 50px">Valor</td>
				<td style="width: 80px">Forma de Pagto</td>
				<td style="width: 80px">Status</td>
				<td style="width: 70px">Pagamento</td>
				<td style="width: 50px">Pago</td>
				<td style="width: 140px">Status Transação</td>
				<td style="width: 130px">Recibo de doação</td>
			</tr>
		</thead>
		<tbody>	
<?php foreach ($this->payload->getCollection() as $item):?>
			<tr>
				<td class="centro"><?= $item->getId()?></td>
				<td class="centro"><?= $this->dateFormat($item->getDataHora(),IntlDateFormatter::SHORT)?></td>
				<td><?= $item->getPessoa()->getNome()?></td>
				<td class="centro"><?= $this->cpfFormat($item->getPessoa()->getCpf())?></td>
				<td class="centro"><?= $this->dateFormat($item->getPessoa()->getDtNascimento(),IntlDateFormatter::SHORT)?></td>
				<td class="centro"><?= $this->currencyFormat($item->getValor(),'BRL') ?></td>
				<td class="centro"><?= $item->getFormaPagamentoDescritivo()?></td>
				<td class="centro"><?= $item->getStatusDescritivo()?></td>
				<td class="centro"><?= $this->dateFormat($item->getDtPagamento(),IntlDateFormatter::SHORT)?></td>
				<td class="centro"><?= $this->currencyFormat($item->getValorPago(),'BRL') ?></td>
				<td class="centro"><?=($item->getStatTran() ? $item->getStatTran()->getDescricao() : '')?></td>
				<td class="centro"><?= ($item->getRecibo() ? $item->getRecibo()->getNumeroReciboFormatado() : '')?>
			</tr>
<?php endforeach;?>
		</tbody>
	</table>	
</body>
</html>
```

### Uso

*	Para CSV fazer requisição com o header Accept: text/csv e o parametro get filename=nomeDoArquivo
*	Para PDF fazer requisição com o header Accept: application/pdf e o parametro get filename=nomeDoArquivo
