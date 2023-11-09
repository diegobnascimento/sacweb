<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $opcod = $_GET['opcod'];
    if ((empty($opcod)) or ($opcod == 'undefined')) {
		header('Location: ./vendedores.php');
		exit();
	}
		
	$delete = "DELETE FROM tbop WHERE opcod = $opcod";
	$result = mysqli_query($conexao, $delete);
	
	if(mysqli_affected_rows($conexao) > 0){
				echo '<script>
                        //alert("VENDEDOR EXCLUÍDO COM SUCESSO.");
                        window.location = "vendedores.php";
                      </script>';
                
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSÃO DO VENDEDOR.");
                        window.location = "vendedores.php";
                      </script>';
			}
?>