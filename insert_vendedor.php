<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $opcod = $_GET['opcod'];
    if (empty($opcod)) {
        $opcod = 'NULL';
    }
    $opnome = $_POST['opnome'];
    $opsenha = md5($_POST['opsenha']);
    $opmail = $_POST['opmail'];
    $opcel = $_POST['opcel'];
    $opreg = $_POST['opreg'];
    $optipo = $_POST['select_perfil'];
    if ($optipo == 'COMUM') {
        $optipo = 'V';
    } else {
        $optipo = 'G';
    }

    $opnome = strtoupper($opnome);
    $opreg = strtoupper($opreg);
	
	$insert = "INSERT INTO tbop (opcod, opnome, opsenha, opmail, opcel, opreg, optipo) VALUES ($opcod,'$opnome','$opsenha','$opmail','$opcel','$opreg', '$optipo')
    ON DUPLICATE KEY UPDATE opnome = '$opnome', opsenha = '$opsenha', opmail = '$opmail', opcel = '$opcel', opreg = '$opreg', optipo = '$optipo'";
	$result = mysqli_query($conexao, $insert);
	
	if(mysqli_affected_rows($conexao) > 0){
        
        if ($opcod == 'NULL') {                    
				echo '<script>
                        //alert("VENDEDOR CADASTRADO COM SUCESSO.");
                        window.location = "vendedores.php";
                      </script>';
        } else {
                echo '<script>
                        //alert("VENDEDOR ATUALIZADO COM SUCESSO.");
                        window.location = "vendedores.php";
                      </script>';
        }
                
			}else{
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "vendedores.php";
                      </script>';
			}
?>
