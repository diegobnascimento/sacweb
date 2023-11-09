<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include('login/verifica_login.php');
	include_once("login/conexao.php");
    $cliop = $cliop.$_SESSION['opcod'];
    $clicod = $_GET['clicod'];
    if (empty($clicod)) {
        $clicod = 'NULL';
    }
    $clinome = $_POST['clinome'];
    $clidoc = $_POST['clidoc'];
    $cliie = $_POST['cliie'];
    $cliend = $_POST['cliend'];
    $clinum = $_POST['clinum'];
    $clibai = $_POST['clibai'];
    $clicid = $_POST['clicid'];
    $cliuf = $_POST['cliuf'];
    $clicep = $_POST['clicep'];
    $climail = $_POST['climail']; 
    $clitel = $_POST['clitel'];
    $clicel = $_POST['clicel'];
    $cliobs1 = $_POST['cliobs1'];
    $cliobs2 = $_POST['cliobs2'];
    $cliobs3 = $_POST['cliobs3'];

    $clinome = strtoupper($clinome);    
    $cliend = strtoupper($cliend);   
    $clibai = strtoupper($clibai);
    $clicid = strtoupper($clicid);
    $cliuf = strtoupper($cliuf);
    $climail = strtolower($climail);
   
	$insert = "INSERT INTO tbcli (clicod, clinome, clidoc, cliie, cliend, clinum, clibai, clicid, cliuf, clicep, climail, clitel, clicel, cliop, cliobs1, cliobs2, cliobs3) VALUES ($clicod,'$clinome','$clidoc','$cliie','$cliend','$clinum','$clibai','$clicid','$cliuf','$clicep','$climail','$clitel','$clicel',$cliop, '$cliobs1', '$cliobs2', '$cliobs3')
    ON DUPLICATE KEY UPDATE clinome = '$clinome', clidoc = '$clidoc', cliie = '$cliie', cliend = '$cliend', 
	clinum = '$clinum', clibai = '$clibai', clicid = '$clicid', cliuf = '$cliuf', clicep = '$clicep', climail = '$climail', clitel = '$clitel', clicel = '$clicel', cliobs1 = '$cliobs1', cliobs2 = '$cliobs2', cliobs3 = '$cliobs3'";
	$result = mysqli_query($conexao, $insert);
	
	if(mysqli_affected_rows($conexao) > 0){
        
        if ($clicod == 'NULL') {                    
				echo '<script>
                        //alert("CLIENTE CADASTRADO COM SUCESSO.");
                        window.location = "clientes.php";
                      </script>';
        } else {
                echo '<script>
                        //alert("CLIENTE ATUALIZADO COM SUCESSO.");
                        window.location = "clientes.php";
                      </script>';
        }
                
			}else{
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "clientes.php";
                      </script>';
			}
?>