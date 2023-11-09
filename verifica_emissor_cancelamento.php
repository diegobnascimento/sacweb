<?php include('login/conexao.php');?>
<?php $pedcod = $_GET['pedcod']; ?>
<?php $emissordir = $_GET['emissornome']; ?>
<?php

$query_verifica_emissor = "SELECT pedemissordir FROM tbped WHERE pedcod = $pedcod";
$result_verifica_emissor = mysqli_query($conexao, $query_verifica_emissor) or die(mysqli_error());
$reg_verifica_emissor = mysqli_num_rows($result_verifica_emissor);
$linhas_verifica_emissor = mysqli_fetch_assoc($result_verifica_emissor);
$emissordir = $linhas_verifica_emissor['pedemissordir'];

if ($emissordir == '') {
	$emissordir = 'PRINCIPAL';	
}

header('Location: nfe/'.$emissordir.'/cancelarNotaFiscal.php?pedcod='.$pedcod);

?>
 