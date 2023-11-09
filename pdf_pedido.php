<?php
require('fpdf/fpdf.php');
include('login/conexao.php');
$pedcod = $_GET['pedcod'];

$query_tbemp = "SELECT * FROM tbemp WHERE empcod = 1";
$result_tbemp = mysqli_query($conexao, $query_tbemp) or die(mysqli_error());
$reg_tbemp = mysqli_num_rows($result_tbemp);
$linhas_tbemp = mysqli_fetch_assoc($result_tbemp);

$empcnpj = preg_replace("/\D/", '', $linhas_tbemp['empcnpj']);
$empcnpj = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $empcnpj);

$empcep = substr($linhas_tbemp['empcep'], 0, 5) . '-' . substr($linhas_tbemp['empcep'], 5, 3);

if (strlen($linhas_tbemp['emptel']) == 10){
    $emptel = '(' . substr($linhas_tbemp['emptel'], 0, 2) . ') ' . substr($linhas_tbemp['emptel'], 2, 4) . '-' . substr($linhas_tbemp['emptel'], 6);
} else {
    $emptel = '(' . substr($linhas_tbemp['emptel'], 0, 2) . ') ' . substr($linhas_tbemp['emptel'], 2, 5) . '-' . substr($linhas_tbemp['emptel'], 7);
}


$query_tbped = "SELECT pedcli, pedncli, pedfor, pednfor, pedop, pednop, peddata, pedhora, pedtipo, 
pedtot, pedfrete, peddesc, pedvol, pedqvol, pedobs FROM tbped WHERE pedcod = $pedcod";
$result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
$reg_tbped = mysqli_num_rows($result_tbped);
$linhas_tbped = mysqli_fetch_assoc($result_tbped);

$query_tbfor = "SELECT fornome, fordoc, forie, forend, fornum, forbai, forcid, foruf, forcep, formail, fortel, forcel, forobs1, forobs2, forobs3 FROM tbfor WHERE forcod = ".$linhas_tbped['pedfor'];
$result_tbfor = mysqli_query($conexao, $query_tbfor) or die(mysqli_error());
$reg_tbfor = mysqli_num_rows($result_tbfor);
$linhas_tbfor = mysqli_fetch_assoc($result_tbfor);

$query_tbcli = "SELECT clidoc, clinome, cliie, cliend, clinum, clibai, clicid, cliuf, clicep, climail, clitel, clicel, cliobs1, cliobs2, cliobs3 FROM tbcli WHERE clicod = ".$linhas_tbped['pedcli'];
$result_tbcli = mysqli_query($conexao, $query_tbcli) or die(mysqli_error());
$reg_tbcli = mysqli_num_rows($result_tbcli);
$linhas_tbcli = mysqli_fetch_assoc($result_tbcli);

if ($linhas_tbped['pedtipo'] == '0') {
    $pedtipo = 'COMPRA';
    $cli_for = 'FORNECEDOR';
    $cli_for_nome = $linhas_tbfor['fornome'];
    $cli_for_doc = $linhas_tbfor['fordoc'];
    $cli_for_ie = $linhas_tbfor['forie'];
    $cli_for_end = $linhas_tbfor['forend'];
    $cli_for_num = $linhas_tbfor['fornum'];
    $cli_for_bai = $linhas_tbfor['forbai'];
    $cli_for_cid = $linhas_tbfor['forcid'];
    $cli_for_uf = $linhas_tbfor['foruf'];
    $cli_for_cep = $linhas_tbfor['forcep'];
    $cli_for_mail = $linhas_tbfor['formail'];
    $cli_for_tel = str_replace(array('(', ')',' ', '-' ),'',$linhas_tbfor['fortel']);
    $cli_for_cel = str_replace(array('(', ')',' ', '-' ),'',$linhas_tbfor['forcel']);
    $cli_for_obs1 = $linhas_tbfor['forobs1'];
    $cli_for_obs2 = $linhas_tbfor['forobs2'];
    $cli_for_obs3 = $linhas_tbfor['forobs3'];
} else {
    $pedtipo = 'VENDA';
    $cli_for = 'CLIENTE';
    $cli_for_nome = $linhas_tbcli['clinome'];
    $cli_for_doc = $linhas_tbcli['clidoc'];
    $cli_for_ie = $linhas_tbcli['cliie'];
    $cli_for_end = $linhas_tbcli['cliend'];
    $cli_for_num = $linhas_tbcli['clinum'];
    $cli_for_bai = $linhas_tbcli['clibai'];
    $cli_for_cid = $linhas_tbcli['clicid'];
    $cli_for_uf = $linhas_tbcli['cliuf'];
    $cli_for_cep = $linhas_tbcli['clicep'];
    $cli_for_mail = $linhas_tbcli['climail'];
    $cli_for_tel = str_replace(array('(', ')',' ', '-' ),'',$linhas_tbcli['clitel']);
    $cli_for_cel = str_replace(array('(', ')',' ', '-' ),'',$linhas_tbcli['clicel']);
    $cli_for_obs1 = $linhas_tbcli['cliobs1'];
    $cli_for_obs2 = $linhas_tbcli['cliobs2'];
    $cli_for_obs3 = $linhas_tbcli['cliobs3'];
}

$cli_for_doc = preg_replace("/\D/", '', $cli_for_doc);
  
if (strlen($cli_for_doc) === 11) {
$cli_for_doc = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cli_for_doc);
} else {
$cli_for_doc = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cli_for_doc);
}

$cli_for_tel = '(' . substr($cli_for_tel, 0, 2) . ') ' . substr($cli_for_tel, 2, 4) . '-' . substr($cli_for_tel, 6);
$cli_for_cel = '(' . substr($cli_for_cel, 0, 2) . ') ' . substr($cli_for_cel, 2, 5) . '-' . substr($cli_for_cel, 7);

$query_tbop = "SELECT opreg, opmail, opcel FROM tbop WHERE opcod = ".$linhas_tbped['pedop'];
$result_tbop = mysqli_query($conexao, $query_tbop) or die(mysqli_error());
$reg_tbop = mysqli_num_rows($result_tbop);
$linhas_tbop = mysqli_fetch_assoc($result_tbop);

$query_tbsai = "SELECT saicod, saipro, sainpro, saigtin, saium, saiqtd, saival, saidesc, saitot FROM tbsai WHERE saiped = $pedcod";
$result_tbsai = mysqli_query($conexao, $query_tbsai) or die(mysqli_error());
$reg_tbsai = mysqli_num_rows($result_tbsai);
$linhas_tbsai = mysqli_fetch_assoc($result_tbsai);

$opcel = '(' . substr($linhas_tbop['opcel'], 0, 2) . ') ' . substr($linhas_tbop['opcel'], 2, 5) . '-' . substr($linhas_tbop['opcel'], 7);

$total_venda=0;
$total_produto=0;
$data = date_create($linhas_tbped['peddata']);
$hora = date_create($linhas_tbped['pedhora']);
$data = date_format($data, 'd/m/Y');
$hora = date_format($hora, 'H:i');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('img/logotipo.png',10,10,-300);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(110);
$pdf->Cell(90, 7, mb_strtoupper($linhas_tbemp['empfant']).' - TEL.: '.$emptel, 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(110);
$pdf->Cell(90, 7, mb_strtoupper($linhas_tbemp['empend']).', '.$linhas_tbemp['empnum'], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(110);
$pdf->Cell(90, 7, $empcep.' - '.mb_strtoupper($linhas_tbemp['empcid']).' / '.$linhas_tbemp['empuf'], 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(110);
$pdf->Cell(90, 7, 'CNPJ: '.$empcnpj.' / IE: '.$linhas_tbemp['empie'], 0, 1, 'R');

$pdf->ln(5);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(190, 10, 'PEDIDO DE '.$pedtipo.' '.$pedcod, 'LTRB', 1, 'C');
$pdf->ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 7, $cli_for, 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(105);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(90, 7, 'VENDEDOR', 0, 1, 'L');
} else {
	$pdf->Cell(90, 7, '', 0, 1, 'L');	
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, mb_strtoupper($cli_for_nome), 'LTR', 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(105);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(95, 7, mb_strtoupper($linhas_tbped['pednop']), 'LTR', 1, 'L');
} else {
	$pdf->Cell(95, 7, '', '', 1, 'L');
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, 'TEL.: '.$cli_for_tel.'  /  CEL.: '.$cli_for_cel, 'LR', 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(105);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(95, 7, 'REGIAO: '.mb_strtoupper($linhas_tbop['opreg']), 'LR', 1, 'L');
} else {
	$pdf->Cell(95, 7, '', '', 1, 'L');
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, 'CPF/CNPJ: '.$cli_for_doc.'  /  IE: '.$cli_for_ie, 'LR', 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(105);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(95, 7, 'CEL.: '.$opcel, 'LR', 1, 'L');
} else {
	$pdf->Cell(95, 7, '', '', 1, 'L');
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, 'E-MAIL: '.$cli_for_mail, 'LR', 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(105);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(95, 7, 'E-MAIL: '.$linhas_tbop['opmail'], 'LRB', 1, 'L');
} else {
	$pdf->Cell(95, 7, '', '', 1, 'L');
}
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, mb_strtoupper($cli_for_end).', '.$cli_for_num, 'LR', 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, mb_strtoupper($cli_for_bai), 'LR', 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(105);
$pdf->Cell(90, 7, 'DATA DO PEDIDO', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(155);
$pdf->Cell(90, 7, 'HORA DO PEDIDO', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 7, mb_strtoupper($cli_for_cid).' / '.$cli_for_uf.' - CEP: '.$cli_for_cep, 'LRB', 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(105);
$pdf->Cell(45, 7, $data, 'LTRB', 0, 'R');
$pdf->SetX(155);
$pdf->Cell(45, 7, $hora, 'LTRB', 1, 'R');
$pdf->ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 7, 'PRODUTOS DO PEDIDO', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(17, 7, 'ID', 'LT', 0, 'L');
$pdf->SetFont('Arial', 'B', 11);
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->Cell(71, 7, 'PRODUTO', 'LTB', 0, 'L');
} else {
	$pdf->Cell(119, 7, 'PRODUTO', 'LTB', 0, 'L');
}
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 7, 'CODIGO', 'LT', 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(10, 7, 'UM', 'LT', 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(14, 7, 'QTD', 'LTR', 0, 'C');
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(21, 7, 'VALOR', 'T', 0, 'C');
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(27, 7, 'TOTAL', 'LTR', 0, 'C');
} 

if($reg_tbsai > 0) {
 //inicia o loop que vai mostrar todos os dados
do {
	
	if ($linhas_tbped['pedtipo'] == '1') {
		if ((strlen($linhas_tbsai['sainpro'])>100) or ($linhas_tbsai['saidesc'] > 0)) {
			$cell_altura = 14;		
		} else {
			$cell_altura = 7;		
		}
		$pdf->ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, $cell_altura, $linhas_tbsai['saipro'], 'LTBR', 0, 'LR');	  
		if (strlen($linhas_tbsai['sainpro'])>100) {
			$y = $pdf->GetY();
			$x = $pdf->GetX();	
			$pdf->SetXY($x, $y-3);
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(71, $cell_altura, substr(mb_strtoupper($linhas_tbsai['sainpro']), 0, 31));
			$pdf->SetXY($x, $y+3);
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(71, $cell_altura-3, substr(mb_strtoupper($linhas_tbsai['sainpro']), 31, 62), 'B', 0, 'L');		
			$y = $pdf->GetY();
			$x = $pdf->GetX();		
			$pdf->SetXY($x, $y-3);
		} else {
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(71, $cell_altura, substr(mb_strtoupper($linhas_tbsai['sainpro']), 0, 31), 'LTB', 0, 'L');
		}
	} else {
		if (strlen($linhas_tbsai['sainpro'])>79) {
			$cell_altura = 14;		
		} else {
			$cell_altura = 7;		
		}
		$pdf->ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, $cell_altura, $linhas_tbsai['saipro'], 'LTBR', 0, 'LR');	  
		if (strlen($linhas_tbsai['sainpro'])>79) {
			$y = $pdf->GetY();
			$x = $pdf->GetX();	
			$pdf->SetXY($x, $y-3);
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(119, $cell_altura, substr(mb_strtoupper($linhas_tbsai['sainpro']), 0, 79));
			$pdf->SetXY($x, $y+3);
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(119, $cell_altura-3, substr(mb_strtoupper($linhas_tbsai['sainpro']), 79, 159), 'B', 0, 'L');		
			$y = $pdf->GetY();
			$x = $pdf->GetX();		
			$pdf->SetXY($x, $y-3);
		} else {
			$pdf->SetFont('Arial', '', 10); 	
			$pdf->Cell(119, $cell_altura, substr(mb_strtoupper($linhas_tbsai['sainpro']), 0, 79), 'LTB', 0, 'L');
		}
	}
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(30, $cell_altura, $linhas_tbsai['saigtin'], 'LTB', 0, 'C');	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(10, $cell_altura, $linhas_tbsai['saium'], 'LTB', 0, 'C');	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(14, $cell_altura, str_replace('.00','',number_format($linhas_tbsai['saiqtd'], 2, '.','')), 'LTBR', 0, 'R');	
	$pdf->SetFont('Arial', '', 10);	
	
	if ($linhas_tbped['pedtipo'] == '1') {
		$pdf->Cell(21, $cell_altura, 'R$ '.number_format($linhas_tbsai['saival'], 2, ',', '.'), 'TB', 0, 'R');	
		$pdf->SetFont('Arial', '', 10);		
		if ($linhas_tbsai['saidesc'] > 0) {
			$y = $pdf->GetY();
			$x = $pdf->GetX();	
			$pdf->SetXY($x, $y+5);
			$pdf->SetFont('Arial', '', 10); 
			$pdf->SetTextColor(194,8,8); 			
			$pdf->Cell(27, $cell_altura, '-R$ '.number_format($linhas_tbsai['saidesc'], 2, ',', '.'), '', 0, 'R');
			$pdf->SetTextColor(0,0,0);
			$pdf->SetXY($x, $y);
			$pdf->SetFont('Arial', '', 10); 				 
			$pdf->Cell(27, $cell_altura, number_format($linhas_tbsai['saitot'], 2, ',', '.'), 'LTBR', 0, 'R');
		} else {
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(27, $cell_altura, 'R$ '.number_format($linhas_tbsai['saitot'], 2, ',', '.'), 'LTBR', 0, 'R');	
		}				
		$total_produto = $linhas_tbsai['saiqtd'] * $linhas_tbsai['saival'];
		$total_venda = $total_venda + $total_produto;
	}

 //finaliza o loop que vai mostrar os dados
    }while($linhas_tbsai = mysqli_fetch_assoc($result_tbsai));
 //fim do if 
}

$pdf->ln();
if ($linhas_tbped['pedtipo'] == '1') {
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(163, 7, 'TOTAL DOS PRODUTOS', 'L', 0, 'R');
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(27, 7, 'R$ '.number_format($total_venda, 2, ',', '.'), 'LRB', 1, 'R');

	if ($linhas_tbped['peddesc'] > 0) {
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->Cell(163, 7, 'DESCONTO', 'L', 0, 'R');	
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetTextColor(194,8,8);
		$pdf->Cell(27, 7, '- R$ '.number_format($linhas_tbped['peddesc'], 2, ',', '.'), 'LRB', 1, 'R');	
		$pdf->SetTextColor(0,0,0);
	}
	if ($linhas_tbped['pedfrete'] > 0) {
		$pdf->SetFont('Arial', 'B', 11);
		$pdf->Cell(163, 7, 'FRETE', 'L', 0, 'R');	
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(27, 7, '+ R$ '.number_format($linhas_tbped['pedfrete'], 2, ',', '.'), 'LRB', 1, 'R');	
	}
	$pdf->SetFont('Arial', 'B', 15);
	$pdf->Cell(163, 10, 'TOTAL DO PEDIDO', 'LB', 0, 'R');
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(27, 10, 'R$ '.number_format($linhas_tbped['pedtot'], 2, ',', '.'), 'LRB', 1, 'R');
	if ($linhas_tbped['pedvol'] != '') {
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetX(105);
		$pdf->Cell(90, 7, 'TIPO DE VOLUME', 0, 0, 'L');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetX(155);
		$pdf->Cell(90, 7, 'QTD DE VOLUMES', 0, 1, 'L');
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetX(105);
		$pdf->Cell(45, 7, $linhas_tbped['pedvol'], 'LTRB', 0, 'R');	
		$pdf->SetX(155);
		$pdf->Cell(45, 7, $linhas_tbped['pedqvol'], 'LTRB', 1, 'R');	
	}
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(90, 7, 'OBSERVACAO', 0, 1, 'L');
	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(190, 7, mb_strtoupper($cli_for_obs1), 'LTR', 1, 'L');
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(190, 7, mb_strtoupper($cli_for_obs2), 'LR', 1, 'L');
	$pdf->SetFont('Arial', '', 10);
	header('Content-Type: text/html; charset=utf-8');
	$pdf->Cell(190, 7, mb_strtoupper($linhas_tbped['pedobs']), 'LR', 1, 'L');	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(190, 10, '', 'T', 0, 'C');	
}

ob_end_clean();
$pdf->Output('I','pedido_'.$pedcod.'.pdf');
?>           