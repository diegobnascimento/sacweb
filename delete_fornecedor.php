<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $forcod = $_GET['forcod'];
    if ((empty($forcod)) or ($forcod == 'undefined')) {
			header('Location: ./fornecedores.php');
			exit();
		}
		
	$delete = "DELETE FROM tbfor WHERE forcod = $forcod";
	$result = mysqli_query($conexao, $delete);
	
	if(mysqli_affected_rows($conexao) > 0){
				echo '<script>
                        //alert("FORNECEDOR EXCLUÍDO COM SUCESSO.");
                        window.location = "fornecedores.php";
                      </script>';
                
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSÃO DO FORNECEDOR.");
                        window.location = "fornecedores.php";
                      </script>';
			}
?>