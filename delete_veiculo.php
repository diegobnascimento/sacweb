<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $carcod = $_GET['carcod'];
    if ((empty($carcod)) or ($carcod == 'undefined')) {
			header('Location: ./veiculos.php');
			exit();
		}
		
	$delete = "DELETE FROM tbcar WHERE carcod = $carcod";
	$result = mysqli_query($conexao, $delete);
	
	if(mysqli_affected_rows($conexao) > 0){
				echo '<script>
                        //alert("VEICULO EXCLUÍDO COM SUCESSO.");
                        window.location = "veiculos.php";
                      </script>';
                
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSÃO DO VEICULO.");
                        window.location = "veiculos.php";
                      </script>';
			}
?>