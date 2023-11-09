<?php

$pedcod = $_GET['pedcod'];
include('login/conexao.php'); 
$query_tbped = "SELECT pedchave FROM tbped WHERE pedcod = $pedcod";
$result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
$reg_tbped = mysqli_num_rows($result_tbped);
$linhas_tbped = mysqli_fetch_assoc($result_tbped);

if ($linhas_tbped['pedchave'] == 'SEM CHAVE'){
?>
  <script type="text/javascript">
    window.close();
  </script>
<?php    
}else{

include('login/conexao.php');

$query_tbped = "SELECT pedchave FROM tbped WHERE pedcod = $pedcod";
$result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
$reg_tbped = mysqli_num_rows($result_tbped);
$linhas_tbped = mysqli_fetch_assoc($result_tbped);

$chave = $linhas_tbped['pedchave'];

header ("Location: http://nfe.sacsystem.com.br/xmlnfe/$chave");
}

?>