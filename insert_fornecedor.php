<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include('login/verifica_login.php');
	include_once("login/conexao.php");
    $forcod = $_GET['forcod'];
    if (empty($forcod)) {
        $forcod = 'NULL';
    }
    $fornome = $_POST['fornome'];
    $fordoc = $_POST['fordoc'];
    $forie = $_POST['forie'];
    $forend = $_POST['forend'];
    $fornum = $_POST['fornum'];
    $forbai = $_POST['forbai'];
    $forcid = $_POST['forcid'];
    $foruf = $_POST['foruf'];
    $forcep = $_POST['forcep'];
    $formail = $_POST['formail']; 
    $fortel = $_POST['fortel'];
    $forcel = $_POST['forcel'];
    $forobs1 = $_POST['forobs1'];
    $forobs2 = $_POST['forobs2'];
    $forobs3 = $_POST['forobs3'];

    $fornome = strtoupper($fornome);    
    $forend = strtoupper($forend);   
    $forbai = strtoupper($forbai);
    $forcid = strtoupper($forcid);
    $foruf = strtoupper($foruf);
    $formail = strtolower($formail);
    
    $insert = "INSERT INTO tbfor (forcod, fornome, fordoc, forie, forend, fornum, forbai, forcid, foruf, forcep, formail, fortel, forcel, forobs1, forobs2, forobs3) VALUES ($forcod,'$fornome','$fordoc','$forie','$forend','$fornum','$forbai','$forcid','$foruf','$forcep','$formail','$fortel','$forcel', '$forobs1', '$forobs2', '$forobs3')
    ON DUPLICATE KEY UPDATE fornome = '$fornome', fordoc = '$fordoc', forend = '$forend', fornum = '$fornum', 
    forbai = '$forbai', forcid = '$forcid', foruf = '$foruf', forcep = '$forcep', formail = '$formail', fortel = '$fortel', forcel = '$forcel', forobs1 = '$forobs1', forobs2 = '$forobs2', forobs3 = '$forobs3'";
	$result = mysqli_query($conexao, $insert);
	
	if(mysqli_affected_rows($conexao) > 0){
        
        if ($forcod == 'NULL') {                    
				echo '<script>
                        //alert("FORNECEDOR CADASTRADO COM SUCESSO.");
                        window.location = "fornecedores.php";
                      </script>';
        } else {
                echo '<script>
                        //alert("FORNECEDOR ATUALIZADO COM SUCESSO.");
                        window.location = "fornecedores.php";
                      </script>';
        }
                
			}else{
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "fornecedores.php";
                      </script>';
			}
?>