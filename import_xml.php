<?php

$xml = new DOMDocument();
$xml->load( 'xml/'.$_GET['xml'] );

$ide = $xml->getElementsByTagName( "ide" );
foreach( $ide as $ide ) {
    $cNF = $ide->getElementsByTagName( "cNF" );
    $cNF = $cNF->item(0)->nodeValue;
}

$emit = $xml->getElementsByTagName( "emit" );
foreach( $emit as $emit ) {
    $CNPJ = $emit->getElementsByTagName( "CNPJ" );
    $CNPJ = $CNPJ->item(0)->nodeValue;
    $xNome = $emit->getElementsByTagName( "xNome" );
    $xNome = $xNome->item(0)->nodeValue;
    $xFant = $emit->getElementsByTagName( "xFant" );
    $xFant = $xFant->item(0)->nodeValue;
    $xLgr = $emit->getElementsByTagName( "xLgr" );
    $xLgr = $xLgr->item(0)->nodeValue;
    $nro = $emit->getElementsByTagName( "nro" );
    $nro = $nro->item(0)->nodeValue;
    $xBairro = $emit->getElementsByTagName( "xBairro" );
    $xBairro = $xBairro->item(0)->nodeValue;
    $cMun = $emit->getElementsByTagName( "cMun" );
    $cMun = $cMun->item(0)->nodeValue;
    $xMun = $emit->getElementsByTagName( "xMun" );
    $xMun = $xMun->item(0)->nodeValue;
    $UF = $emit->getElementsByTagName( "UF" );
    $UF = $UF->item(0)->nodeValue;
    $CEP = $emit->getElementsByTagName( "CEP" );
    $CEP = $CEP->item(0)->nodeValue;
    $cPais = $emit->getElementsByTagName( "cPais" );
    $cPais = $cPais->item(0)->nodeValue;
    $xPais = $emit->getElementsByTagName( "xPais" );
    $xPais = $xPais->item(0)->nodeValue;
    $fone = $emit->getElementsByTagName( "fone" );
    $fone = $fone->item(0)->nodeValue;
    $IE = $emit->getElementsByTagName( "IE" );
    $IE = $IE->item(0)->nodeValue;
    $CRT = $emit->getElementsByTagName( "CRT" );
    $CRT = $CRT->item(0)->nodeValue;
}

include_once("login/conexao.php");
$query = "SELECT forcod, fornome FROM tbfor WHERE fordoc = '$CNPJ'";
$result = mysqli_query($conexao, $query) or die(mysqli_error());
$reg = mysqli_num_rows($result);
$linhas = mysqli_fetch_assoc($result);

$pednfor = '';
$pednfor = $linhas['fornome'];
$pedfor = $linhas['forcod'];

if (empty($pednfor)) {
    //echo 'FORNECEDOR NÃO CADASTRADO.';
    $insert = "INSERT INTO tbfor (fornome, fordoc, forie, forend, fornum, forbai, forcid, 
    foruf, forcep, fortel) VALUES ('$xNome','$CNPJ','$IE','$xLgr',
    '$nro','$xBairro','$xMun','$UF','$CEP',
    '$fone')";
	$result = mysqli_query($conexao, $insert);
	
	$query = "SELECT forcod, fornome FROM tbfor WHERE fordoc = '$CNPJ'";
    $result = mysqli_query($conexao, $query) or die(mysqli_error());
    $reg = mysqli_num_rows($result);
    $linhas = mysqli_fetch_assoc($result);
    
    $pednfor = '';
    $pednfor = $linhas['fornome'];
    $pedfor = $linhas['forcod'];
}else{
    //echo 'FORNECEDOR CADASTRADO.';
}

$query = "SELECT empnome FROM tbemp WHERE empcod = 1";
$result = mysqli_query($conexao, $query) or die(mysqli_error());
$reg = mysqli_num_rows($result);
$linhas = mysqli_fetch_assoc($result);
$empnome = $linhas['empnome'];
$insert = "INSERT INTO tbped (pedncli, pedfor, pednfor, peddata, pedhora, pedtot, pedtipo, pednfe) VALUES ('$empnome', $pedfor, '$pednfor', now(), now(), 0, '0', $cNF)";
$result = mysqli_query($conexao, $insert);
$linha = mysqli_fetch_assoc($result);

$pedcod = mysqli_insert_id($conexao);

$det = $xml->getElementsByTagName( "det" );
foreach( $det as $prod ) {
    $cProd = $prod->getElementsByTagName( "cProd" );
    $cProd = $cProd->item(0)->nodeValue;
    $cEAN = $prod->getElementsByTagName( "cEAN" );
    $cEAN = $cEAN->item(0)->nodeValue;
    $xProd = $prod->getElementsByTagName( "xProd" );
    $xProd = $xProd->item(0)->nodeValue;
    $especiais = array("!", "@", "#", "$", "$", "%", "¨", "&", "*", "(", ")");
    $xProd = str_replace($especiais, "", $xProd);
    $NCM = $prod->getElementsByTagName( "NCM" );
    $NCM = $NCM->item(0)->nodeValue;
    $CFOP = $prod->getElementsByTagName( "CFOP" );
    $CFOP = $CFOP->item(0)->nodeValue;
    $uCom = $prod->getElementsByTagName( "uCom" );
    $uCom = $uCom->item(0)->nodeValue;
    $qCom = $prod->getElementsByTagName( "qCom" );
    $qCom = $qCom->item(0)->nodeValue;
    $vUnCom = $prod->getElementsByTagName( "vUnCom" );
    $vUnCom = $vUnCom->item(0)->nodeValue;
    $vProd = $prod->getElementsByTagName( "vProd" );
    $vProd = $vProd->item(0)->nodeValue;
    $cEANTrib = $prod->getElementsByTagName( "cEANTrib" );
    $cEANTrib = $cEANTrib->item(0)->nodeValue;
    $uTrib = $prod->getElementsByTagName( "uTrib" );
    $uTrib = $uTrib->item(0)->nodeValue;
    $qTrib = $prod->getElementsByTagName( "qTrib" );
    $qTrib = $qTrib->item(0)->nodeValue;
    $vUnTrib = $prod->getElementsByTagName( "vUnTrib" );
    $vUnTrib = $vUnTrib->item(0)->nodeValue;
    $indTot = $prod->getElementsByTagName( "indTot" );
    $indTot = $indTot->item(0)->nodeValue;
    $vTotTrib = $prod->getElementsByTagName( "vTotTrib" );
    $vTotTrib = $vTotTrib->item(0)->nodeValue;
    
    $ICMS = $xml->getElementsByTagName( "ICMS" );
    foreach( $ICMS as $ICMS ) {
        $orig = $ICMS->getElementsByTagName( "orig" );
        $orig = $orig->item(0)->nodeValue;
        //$CST_ICMS = $ICMS->getElementsByTagName( "CST" );
        //$CST_ICMS = $CST_ICMS->item(0)->nodeValue;
        $CST_ICMS = '102';
        $CSOSN = $ICMS->getElementsByTagName( "CSOSN" );
        $CSOSN = $CSOSN->item(0)->nodeValue;
        $pICMS = $ICMS->getElementsByTagName( "pICMS" );
        $pICMS = $pICMS->item(0)->nodeValue;
    }
    
    if (empty($pICMS)){
        $pICMS = 0;
    }
    
    $IPI = $xml->getElementsByTagName( "IPI" );
    foreach( $IPI as $IPI ) {
        $cEnq = $IPI->getElementsByTagName( "cEnq" );
        $cEnq = $cEnq->item(0)->nodeValue;
        $CST_IPI = $IPI->getElementsByTagName( "CST" );
        $CST_IPI = $CST_IPI->item(0)->nodeValue;
        $pIPI = $IPI->getElementsByTagName( "pIPI" );
        $pIPI = $pIPI->item(0)->nodeValue;
    }
    
    if (empty($pIPI)){
        $pIPI = 0;
    }
    
    $PIS = $xml->getElementsByTagName( "PIS" );
    foreach( $PIS as $PIS ) {
        $CST_PIS = $PIS->getElementsByTagName( "CST" );
        $CST_PIS = $CST_PIS->item(0)->nodeValue;
        $pPIS = $PIS->getElementsByTagName( "pPIS" );
        $pPIS = $pPIS->item(0)->nodeValue;
    }
    
    if (empty($pPIS)){
        $pPIS = 0;
    }
    
    $COFINS = $xml->getElementsByTagName( "COFINS" );
    foreach( $COFINS as $COFINS ) {
        $CST_COFINS = $COFINS->getElementsByTagName( "CST" );
        $CST_COFINS = $CST_COFINS->item(0)->nodeValue;
        $pCOFINS = $COFINS->getElementsByTagName( "pCOFINS" );
        $pCOFINS = $pCOFINS->item(0)->nodeValue;
    }
    
    if (empty($pCOFINS)){
        $pCOFINS = 0;
    }
    
    $insert = "INSERT INTO tbpro (profcod, pronome, progrupo, proum, procusto, progtin, proncm, proicms,
    proalqicms, proipi, proalqipi, propis, proalqpis, procof, proalqcof, procfopsai, proenquad, 
    proorig) VALUES ('$cProd', '$xProd', '$xFant', '$uCom', $vUnCom, '$cEAN', '$NCM', '$CST_ICMS', $pICMS, 
    '$CST_IPI', $pIPI, '$CST_PIS', $pPIS, '$CST_COFINS', $pCOFINS, '$CFOP', '$cEnq', '$orig')
    ON DUPLICATE KEY UPDATE pronome = '$xProd', progrupo = '$xFant', proum = '$uCom', procusto = $vUnCom, 
    progtin = '$cEAN', proncm = '$NCM', proicms = '$CST_ICMS', proalqicms = $pICMS, 
    proipi = '$CST_IPI', proalqipi = $pIPI, propis = '$CST_PIS', proalqpis = $pPIS, 
    procof = '$CST_COFINS', proalqcof = $pCOFINS, procfopsai = '$CFOP', proenquad = '$cEnq', 
    proorig = '$orig'";
	
	$result = mysqli_query($conexao, $insert);
    $linha = mysqli_fetch_assoc($result);
    
    $query_tbpro = "SELECT profcod FROM tbpro WHERE profcod = '$cProd'";
    $result_tbpro = mysqli_query($conexao, $query_tbpro) or die(mysqli_error());
    $reg_tbpro = mysqli_num_rows($result_tbpro);
    $linhas_tbpro = mysqli_fetch_assoc($result_tbpro);
    $profcod = $linhas_tbpro['profcod'];
    
    $insert = "INSERT INTO tbsai (saiped, saipro, sainpro, saigtin, saium, saiqtd, saival, saitot, 
	saincm, saiicms, saialqicms, saiipi, saialqipi, saipis, saialqpis, saicof, 
	saialqcof, saiorig, saienquad) VALUES ($pedcod, '$profcod', '$xProd', '$cEAN', '$uCom', $qCom, $vUnCom, 
	$vProd, '$NCM', '$CST_ICMS', $pICMS, '$CST_IPI', $pIPI, '$CST_PIS', 
	$pPIS, '$CST_COFINS', $pCOFINS, '$orig', '$cEnq')";
	
	$result = mysqli_query($conexao, $insert);
    $linha = mysqli_fetch_assoc($result);    
}

$total_produto = "UPDATE tbped SET pedtot = (SELECT sum(saitot) FROM tbsai where saiped = $pedcod) WHERE pedcod = $pedcod";
$atualiza_pedido = mysqli_query($conexao, $total_produto);
echo unlink('xml/'.$_GET['xml']);
header('Location: produtos_pedido.php?pedcod='.$pedcod);

?>
