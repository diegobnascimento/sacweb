<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $carcod = $_GET['carcod'];
    if (empty($carcod)) {
        $carcod = 'NULL';
    }

    $carmod = $_POST['carmod'];
    $carfab = $_POST['carfab'];
    $carplaca = $_POST['carplaca'];
    $carporte = $_POST['carporte'];
    $caruf = $_POST['caruf'];
    $carmod = strtoupper($carmod);
    $carfab = strtoupper($carfab);           
    $carplaca = strtoupper($carplaca); 
    
	$insert = "INSERT INTO tbcar (carcod, carmod, carfab, carplaca, carporte, caruf) VALUES ($carcod, '$carmod', '$carfab', '$carplaca', '$carporte', '$caruf')
    ON DUPLICATE KEY UPDATE carmod = '$carmod', carfab = '$carfab', carplaca = '$carplaca', carporte = '$carporte', caruf = '$caruf'";
	$result = mysqli_query($conexao, $insert);
	
	if(mysqli_affected_rows($conexao) > 0){
        
        if ($procod == 'NULL') {                    
				echo '<script>
                        //alert("VEICULO CADASTRADO COM SUCESSO.");
                        window.location = "veiculos.php";
                      </script>';
        } else {
                echo '<script>
                        //alert("VEICULO ATUALIZADO COM SUCESSO.");
                        window.location = "veiculos.php";
                      </script>';
        }
                
			}else{
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "veiculos.php";
                      </script>';
			}
?>