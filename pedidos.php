<?php
$variaveis = '?'.$_SERVER['QUERY_STRING'];
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<html>
  <font face="Verdana">
  <head><meta charset="gb18030">
      <?php include('head.php');?>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>  
      <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
  </head>  
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>
          <?php 
		  $pesquisa = $_GET['pesquisa'];
		  //$pesquisa2 = str_replace(' ','--',$pesquisa);
		  
		  ?>
		  <script>
			var pesquisa = "<?php echo $variaveis; ?>"
  		  </script>
		  <?php
		  
		  $compras_vendas = $_GET['tipo_pedido'];
		  
		  if($compras_vendas == 'vendas' || $compras_vendas == ''){
			  $filtro_pedidos = '1';
			  $check_vendas = 'checked';
			  $check_compras = '';
			  $clifor = 'pedncli';
			  $compras_vendas = '&tipo_pedido=vendas';
		  } else {
			  $filtro_pedidos = '0';
			  $check_compras = 'checked';
			  $check_vendas = '';
			  $clifor = 'pednfor';
			  $compras_vendas = '&tipo_pedido=compras';
		  }		  
		  ?>
          <?php $op = $op.$_SESSION['opcod']; ?>
          <?php $optipo = $optipo.$_SESSION['optipo'];
		  $vendedor = $_GET['vendedor'];
		  if(empty($vendedor) || $vendedor == 'todos'){
			  $id_vendedor = 'todos';
			  $vendedor = 'TODOS VENDEDORES';
		  } else {
				include('login/conexao.php');
				$queryVendedor = "SELECT opcod, opnome FROM tbop WHERE opcod = $vendedor";
				$resultVendedor = mysqli_query($conexao, $queryVendedor) or die(mysqli_error());
				$regVendedor = mysqli_num_rows($resultVendedor);
				$linhasVendedor = mysqli_fetch_assoc($resultVendedor);
				if($regVendedor > 0) {
				// inicia o loop que vai mostrar todos os dados
					do {
						$id_vendedor = $linhasVendedor['opcod'];
						$vendedor = $linhasVendedor['opnome'];
				// finaliza o loop que vai mostrar os dados
					}while($linhasVendedor = mysqli_fetch_assoc($resultVendedor));
				// fim do if
				}
		  }
		  $registros = 25;
      	  $pagina = $_GET['pagina'];
		  $limit_ini = 0;
		  if (empty($pagina)){
			$pagina = 1;								
		  }
		  if($pagina > 1) {				
			$limit_ini = ($pagina*$registros)-($registros);
		  }
		  ?>
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>PEDIDOS</a>			
            </h2>
			<nav class="float-r">
				<input type="radio" id="vendas" name="tipo_pedido" onclick=<?php 
																			$atual =  basename( __FILE__ );
																			echo "tipoPedido('$atual'+'?tipo_pedido=vendas');"
																			?> 
																			value="vendas" <?php echo $check_vendas; ?>>
				<label for="vendas">VENDAS</label>
				<input type="radio" id="compras" name="tipo_pedido" onclick=<?php 																			
																			$atual =  basename( __FILE__ );																			
																			echo "tipoPedido('$atual'+'?tipo_pedido=compras');"
																			?> 
																			value="compras" <?php echo $check_compras; ?>>
				<label for="compras">COMPRAS</label>				
			</nav>	
            <div class="input-container">
			    <?php if ($dispositivo == 'mobile') { ?>
					<select id="select_pedidos" style="width:100%;" name="select_pedidos" onchange=<?php echo "enterClientePedido('$compras_vendas'+'&vendedor='+'$id_vendedor');" ?>>
				<?php } else { ?>
					<select id="select_pedidos" style="width:50%;" name="select_pedidos" onchange=<?php echo "enterClientePedido('$compras_vendas'+'&vendedor='+'$id_vendedor');" ?>>
				<?php }	?>
					<?php if ($pesquisa == 'TODOS') {
						$pesquisa = '';
					}?>
					<option><?php echo $pesquisa ?></option>
					<option>TODOS</option>
					<?php
					include('login/conexao.php');
					if ($filtro_pedidos == '1') {
					
						$queryCLI = "SELECT clinome FROM tbcli group by clinome";
						$resultCLI = mysqli_query($conexao, $queryCLI) or die(mysqli_error());
						$regCLI = mysqli_num_rows($resultCLI);
						$linhasCLI = mysqli_fetch_assoc($resultCLI);
						   if($regCLI > 0) {
							// inicia o loop que vai mostrar todos os dados
							do {
								if ($linhasCLI['clinome'] != $pesquisa) {
						  ?>                  
						  <option><?php echo $linhasCLI['clinome']?></option>
						  
						   <?php
						   }
							// finaliza o loop que vai mostrar os dados
								}while($linhasCLI = mysqli_fetch_assoc($resultCLI));
							// fim do if 
							} 
					} else {
					$queryFOR = "SELECT fornome FROM tbfor group by fornome";
					$resultFOR = mysqli_query($conexao, $queryFOR) or die(mysqli_error());
					$regFOR = mysqli_num_rows($resultFOR);
					$linhasFOR = mysqli_fetch_assoc($resultFOR);
					   if($regFOR > 0) {
						// inicia o loop que vai mostrar todos os dados
						do {  
							if ($linhasFOR['fornome'] != $pesquisa) {
					  ?>                  
					  <option><?php echo $linhasFOR['fornome']?></option>					  
					   <?php
					   }
						// finaliza o loop que vai mostrar os dados
							}while($linhasFOR = mysqli_fetch_assoc($resultFOR));
						// fim do if 
						}
					}
				  ?> 
				</select>
				<!-- <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress=<?php echo "enterPedido('$compras_vendas'+'&vendedor='+'$id_vendedor');" ?>> -->
                <i class="fa fa-search icon"></i>
				<?php
				if ($filtro_pedidos == '1') {
				?>
				<!-- <div style="display:inline-block;width:100%"></div>
					<select id="vendedores" style="width:100%;max-width:200px;min-width:190px;" onchange=<?php echo "filtraVendedor('$atual');" ?>> 
					<option value=<?php echo $id_vendedor; ?>><?php echo $vendedor; ?></option>
					<?php
					if($id_vendedor != 'todos'){
					?>
							<option value='todos'>TODOS VENDEDORES</option>
					<?php
					}
					include('login/conexao.php');
					$queryOP = "SELECT opcod, opnome FROM tbop WHERE opmail <> 'admin@sacsystem'";
					$resultOP = mysqli_query($conexao, $queryOP) or die(mysqli_error());
					$regOP = mysqli_num_rows($resultOP);
					$linhasOP = mysqli_fetch_assoc($resultOP);
					if($regOP > 0) {
					// inicia o loop que vai mostrar todos os dados
						do {
							if($linhasOP['opcod'] != $id_vendedor) {
						?>						
							<option value=<?php echo $linhasOP['opcod'];?>><?php echo $linhasOP['opnome'];?></option>
						<?php
							}
					// finaliza o loop que vai mostrar os dados
						}while($linhasOP = mysqli_fetch_assoc($resultOP));
					// fim do if
					}
					?>
				</select> -->
				<?php } ?>					
            </div>			
            <nav class="float-l">
              <a href="tipo_pedido.php"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
              <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarPedido()">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirPedido(<?php echo $filtro_pedidos; ?>)"> 
              <input type=image id="botao_imprimir" src="img/imprimir.png" style="margin-left:3px;" width="46" height="46" onclick="imprimirPedido()"> 
              <input type=image id="botao_enviar" src="img/enviar.png" style="margin-left:3px;" width="46" height="46" onclick="enviarPedido()">
			  <input type=image id="botao_faturar" src="img/faturar.png" style="margin-left:3px;" width="46" height="46" onclick="finalizaPedido(pesquisa)">
            </nav>
	  </div>
      <!-- TABLE -->
        <table class="table table-action">
            <thead>
                <tr>
					<th class="t-very-small" style="display:none;">ID</th>
                    <th class="t-very-small">PEDIDO</th>
                    <?php
					if ($filtro_pedidos == '1') {
					?>
						<th class="t-medium">CLIENTE</th>
					<?php } else { ?>
						<th class="t-medium">FORNECEDOR</th>
					<?php } ?>
					<th class="t-very-small">DATA</th>
                    <th class="t-very-small">HORA</th>
					<?php
					if ($filtro_pedidos == '1') {
					?>
						<th class="t-medium">VENDEDOR</th>
						<th class="t-little-small">TOTAL</th>
					<?php } ?>                    
                </tr>
            </thead>
            <tbody>
            <?php
            include('login/conexao.php');
					
			if ($optipo == 'G') {
				if($id_vendedor == 'todos'){
					$query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtot, pedtipo 
					FROM tbped WHERE pedtipo = $filtro_pedidos AND pednfesit != 'CANCELADO' AND pednfesit = '' AND pednfesit != 'APOIO' AND $clifor like '%$pesquisa%' 
					ORDER BY pedcod DESC  LIMIT $limit_ini, $registros";
				} else {
					$query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtot, pedtipo 
					FROM tbped WHERE pedop = $id_vendedor AND pedtipo = $filtro_pedidos AND pednfesit != 'CANCELADO' AND pednfesit = '' AND pednfesit != 'APOIO' AND $clifor like '%$pesquisa%' 
					ORDER BY pedcod DESC  LIMIT $limit_ini, $registros";
				}
			} else {
				$query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtot, pedtipo 
				FROM tbped WHERE pedtipo = $filtro_pedidos AND pednfesit != 'CANCELADO' AND pednfesit = '' AND pednfesit != 'APOIO' AND $clifor like '%$pesquisa%' AND pedop = $op 
				ORDER BY pedcod DESC LIMIT $limit_ini, $registros";
			}
            
            $result = mysqli_query($conexao, $query) or die(mysqli_error());
            $reg = mysqli_num_rows($result);
            $linhas = mysqli_fetch_assoc($result);
            $cont = 0;
            if($reg > 0) {
                do {
					$cont = $cont+1;
					if ($cont == ($registros+1)) {							
						break;
					} else {
                    $data = date_create($linhas['peddata']);
                    $hora = date_create($linhas['pedhora']);
                    $data = date_format($data, 'd/m/Y');
                    $hora = date_format($hora, 'H:i');
                    $tipo_pedido = $linhas['pedtipo'];
                    if ($tipo_pedido == '0') {
                        $tipo_pedido = 'ENTRADA';
                    }else{
                        $tipo_pedido = 'VENDA';
                    }
					if ($dispositivo == 'mobile') {
							?>
							<tr>					
							  <td id="<?php echo $linhas['pedcod']?>" onclick="selecionaPedido(this)" style="display:none;"><?php echo $linhas['pedcod']?></td>
							  <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>PEDIDO:</b></div><?php echo $linhas['pedcod']?></td>
							  <?php
								if ($filtro_pedidos == '1') {
								?>
									<td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>CLIENTE:</b></div><?php echo mb_strtoupper($linhas['pedncli'])?></td>
								<?php } else { ?>
									<td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>FORNECEDOR:</b></div><?php echo mb_strtoupper($linhas['pednfor'])?></td>
								<?php } ?>							  							  
							  <td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>DATA:</b></div><?php echo $data?></td>
							  <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>HORA:</b></div><?php echo $hora?></td>
							  <?php
							  if ($filtro_pedidos == '1') {
							  ?>
								<td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>VENDEDOR:</b></div><?php echo mb_strtoupper($linhas['pednop'])?></td>
								<td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaPedido(this)"><div style="display:inline-block;width:30%"><b>TOTAL:</b></div><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>							  
							  <?php } ?>							  
							</tr>
							<?php
						} else {
            ?>
            
                <tr>
					<td id="<?php echo $linhas['pedcod']?>" onclick="selecionaPedido(this)" style="display:none;"><?php echo $linhas['pedcod']?></td>
                    <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaPedido(this)"><?php echo $linhas['pedcod']?></td>
                    <?php
					if ($filtro_pedidos == '1') {
					?>
						<td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaPedido(this)"><?php echo mb_strtoupper($linhas['pedncli'])?></td>
					<?php } else { ?>
						<td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaPedido(this)"><?php echo mb_strtoupper($linhas['pednfor'])?></td>
					<?php } ?>
					<td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaPedido(this)"><?php echo $data?></td>
                    <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaPedido(this)"><?php echo $hora?></td>
					<?php
					if ($filtro_pedidos == '1') {
					?>
						<td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaPedido(this)"><?php echo mb_strtoupper($linhas['pednop'])?></td>
						<td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaPedido(this)"><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>
					<?php } ?>
                    
                </tr>
                
            <?php
						}
					}
                }while($linhas = mysqli_fetch_assoc($result));
            }
            ?>
            </tbody>
        </table>
	</body>

      <?php
        // tira o resultado da busca da memória
        mysqli_free_result($result);
      ?>

  <footer>
      <?php 
	  if($pagina > 1) {  
			?>
			<nav class="float-l">
				<thead>							 
				  <tr>			  
					<th></th>										    
				  </tr>
				</thead>
				<tbody>
					<tr>
						<td style='border:none;text-align:left;'>
							&nbsp;
							<a href="pedidos.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
								<b>ANTERIOR</b>
							</a>
						</td>
					</tr>
				</tbody>
			</nav>
	  <?php }
	  if ($cont == $registros) {
		?>
		<nav class="float-r">
			<thead>							 
			  <tr>			  
				<th></th>										    
			  </tr>
			</thead>
			<tbody>
				<tr>
					<td style='border:none;text-align:right;'>					
						<a href="pedidos.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
							<b>PRÓXIMO</b>
						</a>
						&nbsp;
					</td>            
				</tr>
			</tbody>
		</nav>	    
		<?php
	  }
	  include('footer.php');
	  ?>
  </footer>
  </font>
</html>
