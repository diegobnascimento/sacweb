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
          ?>
      </header>
      <div class="sticky">      
            <h2 class="float-l">
            <a>FORNECEDORES</a>
          </h2>
          <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterFornecedor()">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <a href="cad_fornecedor.php"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
              <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarFornecedor()">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirFornecedor()"> 
          </nav>
	  </div>
      <!-- TABLE -->
        <table id="tab_fornecedor" class="table table-action">

          <thead>
            <tr>
			  <th class="t-very-small" style="display:none;">ID</th>
              <th class="t-medium">FORNECEDOR</th>
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
              
              $query = "SELECT forcod, fornome, forend, fornum, forbai, forcid, foruf FROM tbfor
                        WHERE fornome like '%$pesquisa%' LIMIT $limit_ini, $registros";
              
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
							  <td id="<?php echo $linhas['forcod']?>" onclick="selecionaFornecedor(this)" style="display:none;"><?php echo $linhas['forcod']?></td>
							  <td id="<?php echo $linhas['forcod']?>A" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>NOME:</b></div><?php echo mb_strtoupper($linhas['fornome'])?></td>
							  <td id="<?php echo $linhas['forcod']?>B" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>ENDEREÇO:</b></div><?php echo mb_strtoupper($linhas['forend'])?></td>
							  <td id="<?php echo $linhas['forcod']?>C" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>NÚMERO:</b></div><?php echo $linhas['fornum']?></td>    
							  <td id="<?php echo $linhas['forcod']?>D" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>BAIRRO:</b></div><?php echo mb_strtoupper($linhas['forbai'])?></td>
							  <td id="<?php echo $linhas['forcod']?>E" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>CIDADE:</b></div><?php echo mb_strtoupper($linhas['forcid'])?></td>
							  <td id="<?php echo $linhas['forcod']?>F" onclick="selecionaFornecedor(this)"><div style="display:inline-block;width:30%"><b>UF:</b></div><?php echo $linhas['foruf']?></td>									  
							</tr>
							<?php
						} else {
              ?>
                    <tr>
					  <td id="<?php echo $linhas['forcod']?>" onclick="selecionaFornecedor(this)" style="display:none;"><?php echo $linhas['forcod']?></td>
                      <td id="<?php echo $linhas['forcod']?>A" onclick="selecionaFornecedor(this)"><?php echo mb_strtoupper($linhas['fornome'])?></td>
                      <td id="<?php echo $linhas['forcod']?>B" onclick="selecionaFornecedor(this)"><?php echo mb_strtoupper($linhas['forend'])?></td>
                      <td id="<?php echo $linhas['forcod']?>C" onclick="selecionaFornecedor(this)"><?php echo $linhas['fornum']?></td>    
                      <td id="<?php echo $linhas['forcod']?>D" onclick="selecionaFornecedor(this)"><?php echo mb_strtoupper($linhas['forbai'])?></td>
                      <td id="<?php echo $linhas['forcod']?>E" onclick="selecionaFornecedor(this)"><?php echo mb_strtoupper($linhas['forcid'])?></td>
                      <td id="<?php echo $linhas['forcod']?>F" onclick="selecionaFornecedor(this)"><?php echo $linhas['foruf']?></td>
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
							<a href="fornecedores.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
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
						<a href="fornecedores.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
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