<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include('login/verifica_login.php');
	include_once("login/conexao.php");
    $pedcod = $_GET['pedcod'];
    if (empty($pedcod)) {
        $pedcod = 'NULL';
    }
    $pedcli = $_GET['pedcli'];
    $pedncli = str_replace('%20', ' ', $_GET['pedncli']);
    $pedfor = $_GET['pedfor'];
    $pednfor = str_replace('%20', ' ', $_GET['pednfor']);
    $pedop = $pedop.$_SESSION['opcod'];
    $pednop = $pednop.$_SESSION['usuario'];

    if ($pedcli != ''){
    	$insert = "INSERT INTO tbped (pedcod, pedcli, pedncli, pedop, pednop, peddata, pedhora, pedtot, pedtipo) VALUES ($pedcod, $pedcli, '$pedncli', $pedop, '$pednop', now(), now(), 0, '1')
        ON DUPLICATE KEY UPDATE pedcli = $pedcli, pedncli = '$pedncli'";
		/*$result = mysqli_query($conexao, $insert);
        $linha = mysqli_fetch_assoc($result);*/
		
		if (mysqli_query($conexao, $insert)) {
						
			} else {
			echo '<script>
					alert("FALHA NA CRIAÇÃO DO PEDIDO.");
					window.location = "pedidos.php";
				  </script>';
			}
    }else{
        $query = "SELECT empnome FROM tbemp WHERE empcod = 1";
        $result = mysqli_query($conexao, $query) or die(mysqli_error());
        $reg = mysqli_num_rows($result);
        $linhas = mysqli_fetch_assoc($result);
        $empnome = $linhas['empnome'];
        $insert = "INSERT INTO tbped (pedcod, pedncli, pedfor, pednfor, peddata, pedhora, pedtot, pedtipo) VALUES ($pedcod, '$empnome', $pedfor, '$pednfor', now(), now(), 0, '0')
        ON DUPLICATE KEY UPDATE pedfor = $pedfor, pednfor = '$pednfor'";
    	/*$result = mysqli_query($conexao, $insert);
        $linha = mysqli_fetch_assoc($result);*/
		
		if (mysqli_query($conexao, $insert)) {
						
			} else {
			echo '<script>
					alert("FALHA NA CRIAÇÃO DO PEDIDO.");
					window.location = "pedidos.php";
				  </script>';
			}
    }

    $pedcod = mysqli_insert_id($conexao);
    
	if(mysqli_affected_rows($conexao) > 0){
        
            header('Location: cad_produto_pedido.php?saiped='.$pedcod);
       }else{
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "pedidos.php";
                      </script>';
			}
?>