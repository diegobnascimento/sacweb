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
          <?php $pesquisa = $_GET['pesquisa']; 
		  $tipo_fat = $_GET['tipo_fat'];
		  
		  if($tipo_fat == 'fat_pendente' || $tipo_fat == ''){
			  $check_fat_pendente = 'checked';
			  $check_faturado = '';			  
			  $tipo_fat = '&tipo_fat=fat_pendente';
			  $filtro_fat = "AND pednfesit = 'PENDENTE'";
		  } else {			  
			  $check_faturado = 'checked';
			  $check_fat_pendente = '';			  
			  $tipo_fat = '&tipo_fat=faturado';
			  $filtro_fat = "AND pednfesit != 'PENDENTE' AND pednfe != ''";
		  }?>
          <?php $op = $op.$_SESSION['opcod']; ?>
          <?php
            $optipo = $optipo.$_SESSION['optipo'];
            if ($optipo != 'G') {
                echo '<script>
                        alert("Sem permissão de acesso a esse menu.");
                        window.location = "pedidos.php";
                      </script>';              
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
            include('login/conexao.php');
            $query_tbemp = "SELECT empnfe FROM tbemp WHERE empcod = 1";
            $result_tbemp = mysqli_query($conexao, $query_tbemp) or die(mysqli_error());
            $reg_tbemp = mysqli_num_rows($result_tbemp);
            $linhas_tbemp = mysqli_fetch_assoc($result_tbemp);
          ?>
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>FATURAMENTO</a>
            </h2>
			<nav class="float-r">
				<input type="radio" id="fat_pendente" name="tipo_fat" onclick=<?php 
																			$atual =  basename( __FILE__ );
																			echo "tipoFaturamento('$atual'+'?tipo_fat=fat_pendente');"
																			?> 
																			value="fat_pendente" <?php echo $check_fat_pendente; ?>>
				<label for="fat_pendente">PENDENTE</label>
				<input type="radio" id="faturado" name="tipo_fat" onclick=<?php 																			
																			$atual =  basename( __FILE__ );																			
																			echo "tipoFaturamento('$atual'+'?tipo_fat=faturado');"
																			?> 
																			value="faturado" <?php echo $check_faturado; ?>>
				<label for="faturado">FATURADO</label>				
			</nav>
              <div class="input-container">
			  <?php if ($dispositivo == 'mobile') { ?>
					<select id="select_faturamento" style="width:100%;" name="select_faturamento" onchange=<?php echo "enterClienteFaturamento('$tipo_fat');" ?>>
				<?php } else { ?>
					<select id="select_faturamento" style="width:50%;" name="select_faturamento" onchange=<?php echo "enterClienteFaturamento('$tipo_fat');" ?>>
				<?php }	?>
					<?php if ($pesquisa == 'TODOS') {
						$pesquisa = '';
					}?>
					<option><?php echo $pesquisa ?></option>
					<option>TODOS</option>
					<?php
					include('login/conexao.php');
					
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
				  ?> 
				</select>
                <!-- <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterFaturamento()"> -->				
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <input type=image id="botao_faturar" src="img/faturar.png" style="margin-left:3px;" width="46" height="46" onclick="faturarPedido()">
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM') {
              ?>
				<input type=image id="botao_atualizar" src="img/atualizar.png" style="margin-left:3px;" width="46" height="46" onclick="atualizarNfe()">
              <?php
              } else {
              ?>
                <input type="hidden" id="botao_atualizar">
              <?php
              }
              ?>
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="cancelarNfe()"> 
              <input type=image id="botao_imprimir" src="img/imprimir.png" style="margin-left:3px;" width="46" height="46" onclick="imprimirDanfe()">
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM') {
              ?>
                  <input type=image id="botao_xml" src="img/xml.png" style="margin-left:3px;" width="46" height="46" onclick="baixarXML()"> 
                  <input type=image id="botao_enviar" src="img/enviar.png" style="margin-left:3px;" width="46" height="46" onclick="enviarDanfeXML()"> 
              <?php
              } else {
              ?>
                  <input type="hidden" id="botao_xml"> 
                  <input type=image id="botao_enviar" src="img/enviar.png" style="margin-left:3px;" width="46" height="46" onclick="enviarPedido()"> 
              <?php
              }
              ?>
          </nav>
	  </div>
      <!-- TABLE -->
        <table class="table table-action">
            <thead>
                <tr>
					<th class="t-very-small" style="display:none;">ID</th>
                    <th class="t-very-small">PEDIDO</th>
                    <th class="t-very-small">STATUS</th>
                    <th class="t-medium">CLIENTE</th>
                    <th class="t-very-small">DATA</th>
                    <th class="t-very-small">HORA</th>
                    <th class="t-small">VENDEDOR</th>
                    <th class="t-small">TOTAL</th>
                    <?php
                    if ($linhas_tbemp['empnfe'] == 'SIM') {
                    ?>
                        <th class="t-very-small">NFe</th>
                    <?php
                    }
                    ?>
                    <?php
                    if ($linhas_tbemp['empnfe'] == 'SIM') {
                    ?>
                        <th class="t-small">CHAVE NFe</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>			
            <!-- <tbody style="text-shadow: 1px 0px white;"> -->
            <?php
            
            include('login/conexao.php');
            $query = "SELECT pedcod, pedncli, pednfor, peddata, pedhora, pednop, pedtot, pednfe, pedchave, pednfesit, pedtipo 
			FROM tbped WHERE pedtipo = '1' $filtro_fat AND pednfesit != '' AND pednfesit != 'APOIO' AND pednfesit not like 'UNIFICADO_%' AND pedncli like '%$pesquisa%' ORDER BY peddata DESC, pedhora DESC LIMIT $limit_ini, $registros";			
            
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
                    if ($linhas['pednfesit'] == 'APROVADO'){
                        $cor = 'green';
						$pednfesit = 'APROVADO';
                    }
                    if ($linhas['pednfesit'] == 'FATURADO'){
                        $cor = 'green';
						$pednfesit = 'FATURADO';
                    }
                    if ($linhas['pednfesit'] == 'PENDENTE'){
                        $cor = 'orange';
						$pednfesit = 'PENDENTE';
                    }
                    if ($linhas['pednfesit'] == 'REPROVADO'){
                        $cor = 'red';
						$pednfesit = 'REPROVADO';
                    }
                    if ($linhas['pednfesit'] == 'CANCELADO'){
                        $cor = 'red';
						$pednfesit = 'CANCELADO';
                    }
                    if ($linhas['pednfesit'] == 'PROCESSAMENTO'){
                        $cor = 'blue';
						$pednfesit = 'PROCESSAMENTO';
                    }
                    $tipo_pedido = $linhas['pedtipo'];
                    if ($tipo_pedido == '0') {
                        $tipo_pedido = 'ENTRADA';
                    }else{
                        $tipo_pedido = 'VENDA';
                    }
					if ($dispositivo == 'mobile') {
							?>
							<tr>					
							  <td id="<?php echo $linhas['pedcod']?>" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')" style="display:none;"><?php echo $linhas['pedcod']?></td>
							  <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>PEDIDO:</b></div><?php echo $linhas['pedcod']?></td>
							  <td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>SITUAÇÃO:</b></div><font color="<?php echo $cor; ?>"><b><?php echo $linhas['pednfesit']?></b></font></td>
							  <td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>CLIENTE:</b></div><?php echo mb_strtoupper($linhas['pedncli'])?></td>
							  <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>DATA:</b></div><?php echo $data?></td>
							  <td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>HORA:</b></div><?php echo $hora?></td>
							  <td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>VENDEDOR:</b></div><?php echo mb_strtoupper($linhas['pednop'])?></td>
							  <td id="<?php echo $linhas['pedcod']?>G" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>TOTAL:</b></div><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>
							  <?php
							  if ($linhas_tbemp['empnfe'] == 'SIM') {
							  ?>
							  	<td id="<?php echo $linhas['pedcod']?>H" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><div style="display:inline-block;width:30%"><b>NFe:</b></div><font color="green"><?php echo $linhas['pednfe']?></font></td>
							  <?php
							  }
							  ?>
							  <?php
							  if ($linhas_tbemp['empnfe'] == 'SIM') {
							  ?>
							  	<td id="<?php echo $linhas['pedcod']?>I" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><font color="green" size='1'><div style="display:inline-block;width:30%"><b>CHAVE NFe:</b></div><?php echo $linhas['pedchave']?></font></td>
							  <?php
							  }
							  ?>							  
							</tr>
							<?php
						} else {
            ?>
            
                <tr>
					<td id="<?php echo $linhas['pedcod']?>" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')" style="display:none;"><?php echo $linhas['pedcod']?></td>
                    <td id="<?php echo $linhas['pedcod']?>A" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo $linhas['pedcod']?></td>
                    <td id="<?php echo $linhas['pedcod']?>B" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><font color="<?php echo $cor; ?>"><b><?php echo $linhas['pednfesit']?></b></font></td>
                    <td id="<?php echo $linhas['pedcod']?>C" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo mb_strtoupper($linhas['pedncli'])?></td>
                    <td id="<?php echo $linhas['pedcod']?>D" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo $data?></td>
                    <td id="<?php echo $linhas['pedcod']?>E" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo $hora?></td>
                    <td id="<?php echo $linhas['pedcod']?>F" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo mb_strtoupper($linhas['pednop'])?></td>
                    <td id="<?php echo $linhas['pedcod']?>G" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><?php echo 'R$ '.number_format($linhas['pedtot'], 2, ',', '.')?></td>
                    <?php
                    if ($linhas_tbemp['empnfe'] == 'SIM') {
                    ?>
                        <td id="<?php echo $linhas['pedcod']?>H" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><font color="green"><?php echo $linhas['pednfe']?></font></td>
                    <?php
                    }
                    ?>
                    <?php
                    if ($linhas_tbemp['empnfe'] == 'SIM') {
                    ?>
                        <td id="<?php echo $linhas['pedcod']?>I" onclick="selecionaNfe(this, '<?php echo $pednfesit; ?>')"><font color="green" size='1'><?php echo $linhas['pedchave']?></font></td>
                    <?php
                    }
                    ?>
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
							<a href="faturamento.php?pagina=<?php echo $pagina-1; ?><?php echo $tipo_fat;?>" style="text-decoration:none;">								
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
						<a href="faturamento.php?pagina=<?php echo $pagina+1;?><?php echo $tipo_fat;?>" style="text-decoration:none;">
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