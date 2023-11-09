<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $clicod = $_GET['clicod'];
	
    if ((empty($clicod)) or ($clicod == 'undefined')) {
			header('Location: ./clientes.php');
			exit();
		}
		
	$delete = "DELETE FROM tbcli WHERE clicod = $clicod";
	$result = mysqli_query($conexao, $delete);
	
	if(mysqli_affected_rows($conexao) > 0){
				echo '<script>
                        //alert("CLIENTE EXCLUÍDO COM SUCESSO.");
                        window.location = "clientes.php";
                      </script>';
                
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSÃO DO CLIENTE.");
                        window.location = "clientes.php";
                      </script>';
			}
?>