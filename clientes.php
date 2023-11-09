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
          <?php $cliop = $cliop.$_SESSION['opcod']; ?>
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
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>CLIENTES</a>
          </h2>
          <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterCliente()">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <a href="cad_cliente.php"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
              <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarCliente()">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirCliente()"> 
          </nav>
	  </div>
      <!-- TABLE -->
        <table id="tab_cliente" class="table table-action">

          <thead>
            <tr>
			  <th class="t-very-small" style="display:none;">ID</th>
              <th class="t-medium">CLIENTE</th>
              <th class="t-medium">ENDEREÇO</th>
              <th class="t-very-small">NÚMERO</th>    
              <th class="t-medium">BAIRRO</th>    
              <th class="t-medium">CIDADE</th>
              <th class="t-very-small">UF</th>
            </tr>
          </thead>        
          <tbody>
              
              <?php
              include('login/conexao.php');
              
              if ($optipo == 'G') {
                  
                  $query = "SELECT clicod, clinome, cliend, clinum, clibai, clicid, cliuf FROM tbcli
                        WHERE clinome like '%$pesquisa%' LIMIT $limit_ini, $registros";
              } else {
              
                  $query = "SELECT clicod, clinome, cliend, clinum, clibai, clicid, cliuf FROM tbcli
                        WHERE clinome like '%$pesquisa%' AND cliop = $cliop LIMIT $limit_ini, $registros";                  
              }
              
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
							  <td id="<?php echo $linhas['clicod']?>" onclick="selecionaCliente(this)" style="display:none;"><?php echo $linhas['clicod']?></td>
							  <td id="<?php echo $linhas['clicod']?>A" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>NOME:</b></div><?php echo mb_strtoupper($linhas['clinome'])?></td>
							  <td id="<?php echo $linhas['clicod']?>B" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>ENDEREÇO:</b></div><?php echo mb_strtoupper($linhas['cliend'])?></td>
							  <td id="<?php echo $linhas['clicod']?>C" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>NÚMERO:</b></div><?php echo $linhas['clinum']?></td>    
							  <td id="<?php echo $linhas['clicod']?>D" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>BAIRRO:</b></div><?php echo mb_strtoupper($linhas['clibai'])?></td>
							  <td id="<?php echo $linhas['clicod']?>E" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>CIDADE:</b></div><?php echo mb_strtoupper($linhas['clicid'])?></td>
							  <td id="<?php echo $linhas['clicod']?>F" onclick="selecionaCliente(this)"><div style="display:inline-block;width:30%"><b>UF:</b></div><?php echo $linhas['cliuf']?></td>							  
							</tr>
							<?php
						} else {
              ?>
                    <tr>
					  <td id="<?php echo $linhas['clicod']?>" onclick="selecionaCliente(this)" style="display:none;"><?php echo $linhas['clicod']?></td>
                      <td id="<?php echo $linhas['clicod']?>A" onclick="selecionaCliente(this)"><?php echo mb_strtoupper($linhas['clinome'])?></td>
                      <td id="<?php echo $linhas['clicod']?>B" onclick="selecionaCliente(this)"><?php echo mb_strtoupper($linhas['cliend'])?></td>
                      <td id="<?php echo $linhas['clicod']?>C" onclick="selecionaCliente(this)"><?php echo $linhas['clinum']?></td>    
                      <td id="<?php echo $linhas['clicod']?>D" onclick="selecionaCliente(this)"><?php echo mb_strtoupper($linhas['clibai'])?></td>
                      <td id="<?php echo $linhas['clicod']?>E" onclick="selecionaCliente(this)"><?php echo mb_strtoupper($linhas['clicid'])?></td>
                      <td id="<?php echo $linhas['clicod']?>F" onclick="selecionaCliente(this)"><?php echo $linhas['cliuf']?></td>
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
							<a href="clientes.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
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
						<a href="clientes.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
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