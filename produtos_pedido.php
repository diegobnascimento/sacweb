<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?> 
          <?php $pesquisa = $_GET['pesquisa']; ?> 
          <?php $pedcod = $_GET['pedcod']; ?>
          <?php $optipo = $optipo.$_SESSION['optipo']; 
		  $registros = 50;
      	  $pagina = $_GET['pagina'];
		  $limit_ini = 0;
		  if (empty($pagina)){
			$pagina = 1;								
		  }
		  if($pagina > 1) {				
			$limit_ini = ($pagina*$registros)-($registros);
		  }
		  ?>
          <?php if (empty($pedcod)) {
                    header('Location: ./pedidos.php');
	               exit();
                } ?>
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>PRODUTOS DO PEDIDO: <?php echo $pedcod; ?></a>
          </h2>
          </h2>
              <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterProdutosPedido(<?php echo $pedcod; ?>)">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <a href="cad_produto_pedido.php?saiped=<?php echo $pedcod; ?>"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
              <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarProdutoPedido(<?php echo $pedcod; ?>)">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirProdutoPedido(<?php echo $pedcod; ?>)"> 
              <input type=image id="botao_imprimir" src="img/imprimir.png" style="margin-left:3px;" width="46" height="46" onclick="imprimirPedido2(<?php echo $pedcod; ?>)"> 
              <input type=image id="botao_enviar" src="img/enviar.png" style="margin-left:3px;" width="46" height="46" onclick="enviarPedido2(<?php echo $pedcod; ?>)"> 
              <input type=image id="botao_faturar" src="img/faturar.png" style="margin-left:3px;" width="46" height="46" onclick="finalizaPedido2(<?php echo $pedcod; ?>)">
          </nav>
	  </div>
	  <?php
        include('login/conexao.php');
        $query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtipo, pedtot FROM tbped WHERE pedcod = $pedcod";
        $result = mysqli_query($conexao, $query) or die(mysqli_error());
        $reg = mysqli_num_rows($result);
        $linhas = mysqli_fetch_assoc($result);
        
        $data = date_create($linhas['peddata']);
        $hora = date_create($linhas['pedhora']);
        $data = date_format($data, 'd/m/Y');
        $hora = date_format($hora, 'H:i');
        
        ?>
        <table class="table table-action">
            <thead>
                <tr>					
                    <th class="t-medium"></th>
                    <th class="t-very-small"></th>
                    <th class="t-very-small"></th>
					<?php
						if ($linhas['pedtipo'] == '1') {
					?>
                    <th class="t-small"></th> 
					<th class="t-small"></th>
					<?php
						}
					?>					                    
                </tr>
            </thead>
            <tbody>
                <tr>
					<?php
						if ($linhas['pedtipo'] == '1') {
					?>
						<td>CLIENTE: <?php echo $linhas['pedncli']?></td>
					<?php
						} else {
					?>
						<td>FORNECEDOR: <?php echo $linhas['pednfor']?></td>
					<?php
						}
					?>
                    <td>DATA: <?php echo $data?></td>
                    <td>HORA: <?php echo $hora?></td>
					<?php
						if ($linhas['pedtipo'] == '1') {
					?>
						<td>VENDEDOR: <?php echo $linhas['pednop']?></td>
						<td>TOTAL: R$ <?php echo number_format($linhas['pedtot'], 2, ',', '.')?></td>
					<?php
						}
					?>
                    
                </tr>
            </tbody>
        </table>
      <!-- TABLE -->
        <table class="table table-action" style="margin-top:0px;">
          <thead>
            <tr>			
              <th class="t-very-small" style="display:none;">ID</th>
              <th class="t-medium">PRODUTO</th>
              <th class="t-small">GRUPO</th>
              <th class="t-small">UM</th>
              <th class="t-small">QTD</th>
			  <?php
				if ($linhas['pedtipo'] == '1') {
			  ?>
				  <th class="t-small">VALOR</th>   
				  <th class="t-small">TOTAL</th>
			  <?php } ?>
            </tr>
          </thead>

          <tbody>
             <?php
              include('login/conexao.php');               
              $query = "SELECT saicod, saipro, sainpro, saigrupo, saium, saiqtd, saival, saitot FROM tbsai
                        WHERE sainpro like '%$pesquisa%' AND saiped = $pedcod LIMIT $limit_ini, $registros";
              $result = mysqli_query($conexao, $query) or die(mysqli_error());
              $reg = mysqli_num_rows($result);
              $linhas = mysqli_fetch_assoc($result);               
              $cont = 0;
              if($reg > 0) {
                // inicia o loop que vai mostrar todos os dados
                do {
					$cont = $cont+1;
					if ($cont == ($registros+1)) {							
						break;
					} else {
						if ($dispositivo == 'mobile') {
							?>
							<tr>					
							  <td id="<?php echo $linhas['saicod']?>" onclick="selecionaProdutoPedido(this)" style="display:none;"><?php echo $linhas['saipro']?></td>
							  <td id="<?php echo $linhas['saicod']?>A" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>PRODUTO:</b></div><?php echo mb_strtoupper($linhas['sainpro'])?></td>
							  <td id="<?php echo $linhas['saicod']?>B" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>GRUPO:</b></div><?php echo mb_strtoupper($linhas['saigrupo'])?></td>
							  <td id="<?php echo $linhas['saicod']?>C" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>UM:</b></div><?php echo $linhas['saium']?></td>
							  <td id="<?php echo $linhas['saicod']?>D" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>QUANTIDADE:</b></div><?php echo $linhas['saiqtd']?></td>
							  <?php
								//if ($linhas['pedtipo'] == '1') {
							  ?>
								  <td id="<?php echo $linhas['saicod']?>E" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>PREÇO:</b></div><?php echo 'R$ '.number_format($linhas['saival'], 2, ',', '.')?></td>
								  <td id="<?php echo $linhas['saicod']?>F" onclick="selecionaProdutoPedido(this)"><div style="display:inline-block;width:30%"><b>TOTAL:</b></div><?php echo 'R$ '.number_format($linhas['saitot'], 2, ',', '.')?></td> 
							  <?php //} ?>
							</tr>
							<?php
						} else {
              ?>
                    <tr>
                      <td id="<?php echo $linhas['saicod']?>" onclick="selecionaProdutoPedido(this)" style="display:none;"><?php echo $linhas['saipro']?></td>
                      <td id="<?php echo $linhas['saicod']?>A" onclick="selecionaProdutoPedido(this)"><?php echo mb_strtoupper($linhas['sainpro'])?></td>
                      <td id="<?php echo $linhas['saicod']?>B" onclick="selecionaProdutoPedido(this)"><?php echo mb_strtoupper($linhas['saigrupo'])?></td>
                      <td id="<?php echo $linhas['saicod']?>C" onclick="selecionaProdutoPedido(this)"><?php echo $linhas['saium']?></td>
                      <td id="<?php echo $linhas['saicod']?>D" onclick="selecionaProdutoPedido(this)"><?php echo $linhas['saiqtd']?></td>
					  <?php
						//if ($linhas['pedtipo'] == '1') {
					  ?>
						  <td id="<?php echo $linhas['saicod']?>E" onclick="selecionaProdutoPedido(this)"><?php echo 'R$ '.number_format($linhas['saival'], 2, ',', '.')?></td>
						  <td id="<?php echo $linhas['saicod']?>F" onclick="selecionaProdutoPedido(this)"><?php echo 'R$ '.number_format($linhas['saitot'], 2, ',', '.')?></td>       
					   <?php //} ?>
                    </tr>
              <?php
						}
					}
                // finaliza o loop que vai mostrar os dados
                    }while($linhas = mysqli_fetch_assoc($result));
                // fim do if 
                }              
              ?>                        
          </tbody>
        </table>
        <!-- END TABLE -->
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
							<a href="produtos_pedido.php?pagina=<?php echo $pagina-1; ?>&pedcod=<?php echo $pedcod; ?>" style="text-decoration:none;">								
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
						<a href="produtos_pedido.php?pagina=<?php echo $pagina+1; ?>&pedcod=<?php echo $pedcod; ?>" style="text-decoration:none;">
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
