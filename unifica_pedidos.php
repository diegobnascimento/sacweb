<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include('login/verifica_login.php');
	include_once("login/conexao.php");
	
	$pedcli = $_GET['pedcli'];
	$queryULTIMOPED = "SELECT pedcod, pedfrete, peddesc FROM tbped where pedcli = $pedcli and pednfesit = 'PENDENTE' ORDER BY pedcod DESC LIMIT 1;";
	$resultULTIMOPED = mysqli_query($conexao, $queryULTIMOPED) or die(mysqli_error());
	$regULTIMOPED = mysqli_num_rows($resultULTIMOPED);
	$linhasULTIMOPED = mysqli_fetch_assoc($resultULTIMOPED);
	
	$pedfrete = $linhasULTIMOPED['pedfrete'];
	$peddesc = $linhasULTIMOPED['peddesc'];

	$pedcod = $linhasULTIMOPED['pedcod'];
	
    //if (empty($pedcod)) {
    //   $pedcod = 'NULL';
    //}
	
    if ($pedcod != ''){
		$queryCLIPED = "SELECT pedcod, pedfrete, peddesc FROM tbped WHERE pedcli = $pedcli AND pednfesit = 'PENDENTE' and pedcod <> $pedcod ";
	    $resultCLIPED = mysqli_query($conexao, $queryCLIPED) or die(mysqli_error());
	    $regCLIPED = mysqli_num_rows($resultCLIPED);
	    $linhasCLIPED = mysqli_fetch_assoc($resultCLIPED);	
		
		if($regCLIPED > 0) {			
			do {
				 $pedcod_unifica = $linhasCLIPED['pedcod'];
				 $pedfrete = $pedfrete+$linhasCLIPED['pedfrete'];
				 $peddesc = $peddesc+$linhasCLIPED['peddesc'];
				 
				 $update = "update tbsai set saiped = $pedcod, saiunificado = 'S' where saiped = $pedcod_unifica";
				 
				 $unifica_pedido = mysqli_query($conexao, $update);	
				 
				 $update2 = "update tbped set pednfesit = 'UNIFICADO_$pedcod' where pedcod = $pedcod_unifica";
				 
				 $unifica_pedido2 = mysqli_query($conexao, $update2);
				  
			}while($linhasCLIPED = mysqli_fetch_assoc($resultCLIPED));
                // fim do if 
        } 		
	$total_pedido = "UPDATE tbped SET pedtot = (SELECT sum(saitot) FROM tbsai where saiped = $pedcod)+$pedfrete-$peddesc, pedfrete = $pedfrete, peddesc = $peddesc WHERE pedcod = $pedcod";
	$atualiza_pedido = mysqli_query($conexao, $total_pedido);
    }	
	header('Location: cad_cliente.php?clicod='.$pedcli);	
?>