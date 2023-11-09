<?php
session_cache_expire(10);
session_start();

include('conexao.php');

if(empty($_POST['login']) || empty($_POST['password'])) {     
	header('Location: ../entrar.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, md5($_POST['password']));

$query = "select opcod, opnome, optipo from tbop where opmail = '{$usuario}' and opsenha = '{$senha}'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

$usuario = mysqli_fetch_assoc($result);

if($row == 1) {
	$_SESSION['usuario'] = $usuario["opnome"];
    $_SESSION['opcod'] = $usuario["opcod"];
    $_SESSION['optipo'] = $usuario["optipo"];
    $_SESSION['pesquisa'] = '';
    header('Location: ../index.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;   
	header('Location: ../entrar.php');
	exit();
}
