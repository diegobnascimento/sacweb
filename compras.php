<html>
  <font face="Verdana">
  <head><meta charset="gb18030">
      <?php include('head.php');?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?> 
          <?php $pesquisa = $_GET['pesquisa']; ?>
          <?php $op = $op.$_SESSION['opcod']; ?>
          <?php
            $optipo = $optipo.$_SESSION['optipo'];
            if ($optipo != 'G') {
                echo '<script>
                        alert("Sem permissão de acesso a esse menu.");
                        window.location = "pedidos.php";
                      </script>';              
            }
			$registros = 50;
			$pagina = $_GET['pagina'];
			$limit_ini = 0;
			if (empty($pagina)){
			$pagina = 1;								
			}
			if($pagina > 1) {				
			$limit_ini = ($pagina*$registros)-($registros);
			}
            include('login/conexao.php');
            $query_tbemp = "SELECT empnfe FROM tbemp WHERE empcod = 1";
            $result_tbemp = mysqli_query($conexao, $query_tbemp) or die(mysqli_error());
            $reg_tbemp = mysqli_num_rows($result_tbemp);
            $linhas_tbemp = mysqli_fetch_assoc($result_tbemp);
          ?>
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>COMPRAS</a>
            </h2>
              <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterCompras()">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="cancelarNfe()"> 
              <input type=image id="botao_imprimir" src="img/imprimir.png" style="margin-left:3px;" width="46" height="46" onclick="imprimirDanfe()">
              <input type="hidden" id="botao_xml"> 
              <input type=image id="botao_enviar" src="img/enviar.png" style="margin-left:3px;" width="46" height="46" onclick="enviarPedido()"> 
          </nav>
	  </div>
      <!-- TABLE -->
        <table class="table table-action">
            <thead>
                <tr>
					<th class="t-very-small" style="display:none;">ID</th>
                    <th class="t-very-small">PEDIDO</th>
                    <th class="t-very-small">NFe</th>
                    <th class="t-medium">FORNECEDOR</th>
                    <th class="t-very-small">DATA</th>
                    <th class="t-very-small">HORA</th>
                    <th class="t-small">TOTAL</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            include('login/conexao.php');
            $query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtot, pednfe, pedchave, pednfesit, pedtipo 
			FROM tbped WHERE pedtipo = '0' AND pednfesit = 'RECEBIDO' AND pednfor like '%$pesquisa%' ORDER BY pedcod DESC LIMIT $limit_ini, $registros";
            
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
					if ($dispositivo == 'mobile') {
							?>
							<tr>					
							  <td id="<?php echo $linhas['pedcod']?>" onclick="selecionaCompra(this)" style="display:none;"><?php echo $linhas['pedcod']?></td>
							  <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>PEDIDO:</b></div><?php echo $linhas['pedcod']?></td>
							  <td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>NFe:</b></div><?php echo $linhas['pednfe']?></td>
							  <td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>FORNECEDOR:</b></div><?php echo mb_strtoupper($linhas['pednfor'])?></td>
							  <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>DATA:</b></div><?php echo $data?></td>
							  <td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>HORA:</b></div><?php echo $hora?></td>
							  <td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaCompra(this)"><div style="display:inline-block;width:30%"><b>TOTAL:</b></div><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>							  
							</tr>
							<?php
						} else {
            ?>
                <tr>
					<td id="<?php echo $linhas['pedcod']?>" onclick="selecionaCompra(this)" style="display:none;"><?php echo $linhas['pedcod']?></td>
                    <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaCompra(this)"><?php echo $linhas['pedcod']?></td>
                    <td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaCompra(this)"><?php echo $linhas['pednfe']?></td>
                    <td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaCompra(this)"><?php echo mb_strtoupper($linhas['pednfor'])?></td>
                    <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaCompra(this)"><?php echo $data?></td>
                    <td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaCompra(this)"><?php echo $hora?></td>
                    <td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaCompra(this)"><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>
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
							<a href="compras.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
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
						<a href="compras.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
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
