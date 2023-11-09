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
            <a>VENDEDORES</a>
          </h2>
          <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterVendedor()">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
              <a href="cad_vendedor.php"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
              <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarVendedor()">
              <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirVendedor()"> 
          </nav>
	  </div>
      <!-- TABLE -->
        <table class="table table-action">

          <thead>
            <tr>
			  <th class="t-very-small" style="display:none;">ID</th>
              <th class="t-medium">VENDEDOR</th>
              <th class="t-medium">E-MAIL</th>
              <th class="t-medium">CELULAR</th>
              <th class="t-medium">REGIÃO</th>              
            </tr>
          </thead>

          <tbody>
             <?php
              include('login/conexao.php');               
              $query = "SELECT opcod, opnome, opmail, opcel, opreg FROM tbop
                        WHERE opnome like '%$pesquisa%' AND opmail <> 'admin@sacsystem' LIMIT $limit_ini, $registros";
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
							  <td id="<?php echo $linhas['opcod']?>" onclick="selecionaVendedor(this)" style="display:none;"><?php echo $linhas['vencod']?></td>
							  <td id="<?php echo $linhas['opcod']?>A" onclick="selecionaVendedor(this)"><div style="display:inline-block;width:30%"><b>NOME:</b></div><?php echo mb_strtoupper($linhas['opnome'])?></td>
							  <td id="<?php echo $linhas['opcod']?>B" onclick="selecionaVendedor(this)"><div style="display:inline-block;width:30%"><b>E-MAIL:</b></div><?php echo $linhas['opmail']?></td>
							  <td id="<?php echo $linhas['opcod']?>C" onclick="selecionaVendedor(this)"><div style="display:inline-block;width:30%"><b>CELULAR:</b></div><?php echo $linhas['opcel']?></td>   
							  <td id="<?php echo $linhas['opcod']?>D" onclick="selecionaVendedor(this)"><div style="display:inline-block;width:30%"><b>REGIÃO:</b></div><?php echo mb_strtoupper($linhas['opreg'])?></td> 						  
							</tr>
							<?php
						} else {
              ?>
                    <tr>
					  <td id="<?php echo $linhas['opcod']?>" onclick="selecionaVendedor(this)" style="display:none;"><?php echo $linhas['vencod']?></td>					  
                      <td id="<?php echo $linhas['opcod']?>A" onclick="selecionaVendedor(this)"><?php echo mb_strtoupper($linhas['opnome'])?></td>
                      <td id="<?php echo $linhas['opcod']?>B" onclick="selecionaVendedor(this)"><?php echo $linhas['opmail']?></td>
                      <td id="<?php echo $linhas['opcod']?>C" onclick="selecionaVendedor(this)"><?php echo $linhas['opcel']?></td>   
                      <td id="<?php echo $linhas['opcod']?>D" onclick="selecionaVendedor(this)"><?php echo mb_strtoupper($linhas['opreg'])?></td>   
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
							<a href="vendedores.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
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
						<a href="vendedores.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
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
