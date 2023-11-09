<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
    $pedcod = $_GET['pedcod'];
	$tipo_pedido = $_GET['tipo_pedido'];
	
	if($tipo_pedido == '1'){
		
		if (empty($pedcod)) {
			echo '<script>
					alert("NECESSARIO SELECIONAR UM PEDIDO.");
					window.location = "pedidos.php?tipo_pedido=vendas";
				  </script>';
		}
		
		$delete = "UPDATE tbped SET pednfesit = 'CANCELADO' WHERE pedcod = $pedcod";
		$result = mysqli_query($conexao, $delete);
		
		if(mysqli_affected_rows($conexao) > 0){
					echo '<script>
							//alert("PEDIDO EXCLUÍDO COM SUCESSO.");
							window.location = "pedidos.php?tipo_pedido=vendas";
						  </script>';
					
				}else{
					echo '<script>
							alert("FALHA NO EXCLUSÃO DO PEDIDO.");
							window.location = "pedidos.php?tipo_pedido=vendas";
						  </script>';
				}
	  
	  
	} else {
		
		if (empty($pedcod)) {
			echo '<script>
					alert("NECESSARIO SELECIONAR UM PEDIDO.");
					window.location = "pedidos.php?tipo_pedido=compras";
				  </script>';
		}

		$delete = "UPDATE tbped SET pednfesit = 'CANCELADO' WHERE pedcod = $pedcod";
		$result = mysqli_query($conexao, $delete);
		
		if(mysqli_affected_rows($conexao) > 0){
					echo '<script>
							//alert("PEDIDO EXCLUÍDO COM SUCESSO.");
							window.location = "pedidos.php?tipo_pedido=compras";
						  </script>';
					
				}else{
					echo '<script>
							alert("FALHA NO EXCLUSÃO DO PEDIDO.");
							window.location = "pedidos.php?tipo_pedido=compras";
						  </script>';
				}
	 
	}	
    
?>