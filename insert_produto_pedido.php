<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include('login/verifica_login.php');
	include_once("login/conexao.php");
    $saiped = $_GET['saiped'];
    $saicod = $_GET['saicod'];
    
    if (empty($saiped)) {
        $saiped = 'NULL';
    }
    if (empty($saicod)) {
        $saicod = 'NULL';
    }
    if ($saicod == 'undefined') {
        $saicod = 'NULL';
    }
    
    $saipro = $_GET['saipro'];
    $sainpro = str_replace('%20', ' ', $_GET['sainpro']);
    $saium = $_GET['saium'];
    $saiqtd = $_GET['saiqtd'];
    $saival = str_replace('%20', '', $_GET['saival']);
    $saitot = str_replace('%20', '', $_GET['saitot']);
    $saival = str_replace('R$', '', $saival);
    $saitot = str_replace('R$', '', $saitot);
    $saival = str_replace(',', '.', $saival);
    $saitot = str_replace(',', '.', $saitot);
    
    $query_tbped = "SELECT pedtipo FROM tbped WHERE pedcod = $saiped";
    $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
    $reg_tbped = mysqli_num_rows($result_tbped);
    $linhas_tbped = mysqli_fetch_assoc($result_tbped);
    
    $pedtipo = $linhas_tbped['pedtipo'];
    
    if ($pedtipo === 0) {
        $custo_produto = "UPDATE tbpro SET procusto = $saival WHERE procod = $saipro";
        $atualiza_custo = mysqli_query($conexao, $custo_produto);
    } 
    
    $query_tbpro = "SELECT progtin, progrupo, proncm, procest, proibptfed, proibptest, procst, proalqicms, proipi, proalqipi,
    procstpis, proalqpis, procstcof, proalqcof, propeso, procfopent, procfopsai, proorig, proenquad FROM tbpro WHERE procod = $saipro";	
	
    $result_tbpro = mysqli_query($conexao, $query_tbpro);
    $linha_tbpro = mysqli_fetch_assoc($result_tbpro);
    $saigtin = $linha_tbpro['progtin'];
    $saigrupo = $linha_tbpro['progrupo'];
    $saigrupo = strtoupper($saigrupo);    
    $saincm = $linha_tbpro['proncm'];
	
	$query_tbtrib = "SELECT cest, ncm, fed, est, mun FROM tbtrib WHERE ncm = '$saincm'";
	$result_tbtrib = mysqli_query($conexao, $query_tbtrib);
    $linha_tbtrib = mysqli_fetch_assoc($result_tbtrib);
	
    $saicest = $linha_tbtrib['cest'];	
	$saiibptfed = $linha_tbtrib['fed'];
	$saiibptest = $linha_tbtrib['est'];
	
    $saicst = $linha_tbpro['procst'];
	$saicsosn = $linha_tbpro['procst'];
    $saialqicms = $linha_tbpro['proalqicms'];
    $saiipi = $linha_tbpro['proipi'];
    $saialqipi = $linha_tbpro['proalqipi'];
    $saipis = $linha_tbpro['procstpis'];
    $saialqpis = $linha_tbpro['proalqpis'];
    $saicof = $linha_tbpro['procstcof'];
    $saialqcof = $linha_tbpro['proalqcof'];
    $saipeso = $linha_tbpro['propeso'];
    if ($pedtipo == '0') {
        $saicfop = $linha_tbpro['procfopent'];
    }else{
        $saicfop = $linha_tbpro['procfopsai'];
    }
    $saiorig = $linha_tbpro['proorig'];
    $saienquad = $linha_tbpro['proenquad'];
   
	$insert = "INSERT INTO tbsai (saicod, saiped, saipro, sainpro, saigtin, saium, saiqtd, saival, saitot, 
	saigrupo, saincm, saicest, saiibptfed, saiibptest, saicst, saiicms, saiipi, saialqipi, saicstpis, saialqpis, saicstcof, 
	saialqcof, saipeso, saicfop, saiorig, saienquad, saicsosn) VALUES ($saicod, $saiped, $saipro, '$sainpro', '$saigtin', '$saium', $saiqtd, $saival, 
	$saitot, '$saigrupo', '$saincm', '$saicest', '$saiibptfed', '$saiibptest', '$saicst', $saialqicms, '$saiipi', $saialqipi, '$saipis', 
	$saialqpis, '$saicof', $saialqcof, $saipeso, '$saicfop', '$saiorig', '$saienquad', '$saicsosn')   
    ON DUPLICATE KEY UPDATE saiped = $saiped, saipro = $saipro, sainpro = '$sainpro', saigtin = '$saigtin', 
    saium = '$saium', saiqtd = $saiqtd, saival = $saival, saitot = $saitot, saigrupo = '$saigrupo', 
    saincm = '$saincm', saicest = '$saicest', saiibptfed = '$saiibptfed', saiibptest = '$saiibptest', saicst = '$saicst', saiicms = $saialqicms, 
    saiipi = '$saiipi', saialqipi = $saialqipi, saicstpis = '$saipis', saialqpis = $saialqpis, 
    saicstcof = '$saicof', saialqcof = $saialqcof, saipeso = $saipeso, saicfop = '$saicfop', saiorig = '$saiorig', saienquad = '$saienquad', saicsosn = '$saicsosn'";

	/*$result = mysqli_query($conexao, $insert);
    $linha = mysqli_fetch_assoc($result); */
	
	if (mysqli_query($conexao, $insert)) {
						
			} else {
			echo '<script>
					alert("FALHA NA CRIAÇÃO DO PEDIDO.");
					window.location = "pedidos.php";
				  </script>';
			}
    
    $total_produto = "UPDATE tbped SET pedtot = (SELECT sum(saitot) FROM tbsai where saiped = $saiped) WHERE pedcod = $saiped";
    $atualiza_pedido = mysqli_query($conexao, $total_produto);
    header('Location: cad_produto_pedido.php?saiped='.$saiped);
    
    /*
	if(mysqli_affected_rows($conexao) > 0){
            
        $total_produto = "UPDATE tbped SET pedtot = (SELECT sum(saitot) FROM tbsai where saiped = $saiped) WHERE pedcod = $saiped";
        $atualiza_pedido = mysqli_query($conexao, $total_produto);
        header('Location: produtos_pedido.php?pedcod='.$saiped);
   }else{
		echo '<script>
                alert("FALHA NA INCLUSÃO DO PRODUTO NO PEDIDO.");
                window.location = "pedidos.php";
              </script>';
    }
    */
?>