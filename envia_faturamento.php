<?php

include('login/conexao.php');

$variaveis = '?'.$_SERVER['QUERY_STRING'];
$variaveis = str_replace('pedcod='.$_GET['pedcod'], '', $variaveis);

$pedcod = $_GET['pedcod'];
$frete = $_POST['frete'];
$desconto = $_POST['desconto'];
$total = $_POST['total'];
$frete = str_replace('R$ ', '', $frete);
$desconto = str_replace('R$ ', '', $desconto);
$total = str_replace('R$ ', '', $total);
$frete = str_replace('.', '', $frete);
$desconto = str_replace('.', '', $desconto);
$total = str_replace('.', '', $total);
$frete = str_replace(',', '.', $frete);
$desconto = str_replace(',', '.', $desconto);
$total = str_replace(',', '.', $total);

$update = "UPDATE tbped SET peddata = now(), pedhora = now(), pednfesit = 'PENDENTE', 
pedfrete = $frete, peddesc = $desconto, pedtot = $total WHERE pedcod = $pedcod";

$result = mysqli_query($conexao, $update);

?>
<script type="text/javascript">
    alert('PEDIDO FINALIZADO');
</script>  
<?php
header("Location: pedidos.php".$variaveis);
?>