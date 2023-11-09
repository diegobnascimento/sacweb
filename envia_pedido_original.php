<?php
$empresa = $_GET['empnome'];
$vendedor = $_GET['opnome'];
$pedido = $_GET['pedcod'];
$to = $_POST['email_dest'];
$to = strtolower($to);
$from = "From: ".$empresa." <pedidos@sacsystem.com.br>";
$subject = "Vendedor: ".$vendedor." - Pedido: ".$pedido;
$txt = '<html><body>Clique no link para visualizar o pedido: <a href="http://sacsystem.com.br/sacweb/confort/pdf_pedido.php?pedcod='.$pedido.'">Pedido '.$pedido.'</a></body></html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= $from;

mail($to,$subject,$txt,$headers);
echo "<script>window.location.assign('pedidos.php');</script>";
?>