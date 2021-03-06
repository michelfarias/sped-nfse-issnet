<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use NFePHP\NFSeIssNet\Rps;

$config = [
    'cnpj'  => '99999999000191',
    'im'    => '1733160024',
    'cmun'  => '2403251',
    'razao' => 'Empresa Test Ltda',
    'tpamb' => 2
];

$config = (object) $config;

$std = new \stdClass();
$std->version = '1.00'; //indica qual JsonSchema USAR na validação
$std->IdentificacaoRps = new \stdClass();
$std->IdentificacaoRps->Numero = 11; //limite 15 digitos
$std->IdentificacaoRps->Serie = '1';
$std->IdentificacaoRps->Tipo = 1; //1-RPS 2-Nota Fiscal Conjugada (Mista) 3-Cupom
$std->DataEmissao = '2020-01-12T09:55:22';
$std->NaturezaOperacao = 1; // 1 – Tributação no município
// 2 - Tributação fora do município
// 3 - Isenção
// 4 - Imune
// 5 – Exigibilidade suspensa por decisão judicial
// 6 – Exigibilidade suspensa por procedimento administrativo

$std->RegimeEspecialTributacao = 1;    // 1 – Microempresa municipal
// 2 - Estimativa
// 3 – Sociedade de profissionais
// 4 – Cooperativa
// 5 – MEI – Simples Nacional
// 6 – ME EPP – Simples Nacional

$std->OptanteSimplesNacional = 1; //1 - SIM 2 - Não
$std->IncentivadorCultural = 2; //1 - SIM 2 - Não
$std->Status = 1;  // 1 – Normal  2 – Cancelado

$std->Tomador = new \stdClass();
$std->Tomador->Cnpj = "99999999000191";
$std->Tomador->Cpf = null;
$std->Tomador->InscricaoMunicipal = "3515100";
$std->Tomador->RazaoSocial = "Fulano de Tal";

$std->Tomador->Endereco = new \stdClass();
$std->Tomador->Endereco->Endereco = 'Rua Sibipiruna';
$std->Tomador->Endereco->Numero = '111';
$std->Tomador->Endereco->Complemento = 'Sobre Loja';
$std->Tomador->Endereco->Bairro = 'Centro';
$std->Tomador->Endereco->CodigoMunicipio = '4104808';
$std->Tomador->Endereco->Uf = 'PR';
$std->Tomador->Endereco->Cep = '85807210';

$std->Servico = new \stdClass();
$std->Servico->ItemListaServico = '105';
$std->Servico->CodigoCnae = '6202300';
$std->Servico->CodigoTributacaoMunicipio = '10500';
$std->Servico->Discriminacao = 'Teste de RPS';
$std->Servico->CodigoMunicipio = '4104808';

$std->Servico->Valores = new \stdClass();
$std->Servico->Valores->ValorServicos = 10.00;
$std->Servico->Valores->ValorDeducoes = 0.00;
$std->Servico->Valores->ValorPis = 0.00;
$std->Servico->Valores->ValorCofins = 0.00;
$std->Servico->Valores->ValorInss = 0.00;
$std->Servico->Valores->ValorIr = 0.00;
$std->Servico->Valores->ValorCsll = 0.00;
$std->Servico->Valores->IssRetido = 2;
$std->Servico->Valores->ValorIss = 0.50;
$std->Servico->Valores->BaseCalculo = 10.00;
$std->Servico->Valores->ValorLiquidoNFSe = 10.00;
$std->Servico->Valores->OutrasRetencoes = 0.00;
$std->Servico->Valores->Aliquota = 5;
$std->Servico->Valores->DescontoIncondicionado = 0.00;
$std->Servico->Valores->DescontoCondicionado = 0.00;

/*
  $std->IntermediarioServico = new \stdClass();
  $std->IntermediarioServico->RazaoSocial = 'INSCRICAO DE TESTE SIATU - D AGUA -PAULINO S';
  $std->IntermediarioServico->Cnpj = '99999999000191';
  $std->IntermediarioServico->InscricaoMunicipal = '8041700010';

  $std->ConstrucaoCivil = new \stdClass();
  $std->ConstrucaoCivil->CodigoObra = '1234';
  $std->ConstrucaoCivil->Art = '1234';
 */
$rps = new Rps($std);
$rps->config($config);

header("Content-type: text/xml");
echo $rps->render();

/*
echo "<pre>";
print_r(json_encode($std));
echo "</pre>";
*/

