<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $saiped = $_GET['saiped'];
    $saicod = $_GET['saicod'];
    if ((empty($saicod)) or ($saicod == 'undefined')) {
		if (!empty($saiped)) {		  
			header('Location: ./produtos_pedido.php?pedcod='.$saiped);
			exit();
			}
		}
    	
    $delete_produto = "DELETE FROM tbsai WHERE saicod = $saicod AND saiped = $saiped";
    $result_produto =  mysqli_query($conexao, $delete_produto);	
	
	if(mysqli_affected_rows($conexao) > 0){
        
         $total_produto = "UPDATE tbped SET pedtot = (SELECT sum(saitot) FROM tbsai where saiped = $saiped) WHERE pedcod = $saiped";
         $atualiza_pedido = mysqli_query($conexao, $total_produto);
        header('Location: produtos_pedido.php?pedcod='.$saiped);				
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSÃO DO PRODUTO.");                        
                      </script>';
			}
?>