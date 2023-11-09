<?php
define('HOST', '[SERVIDOR]]');
define('USUARIO', '[USUARIO]');
define('SENHA', '[SENHA]');
define('DB', '[NOME_BANCO]');
 
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('<script>alert("Não foi possível conectar ao banco de dados.");</script>');
?>
