<html>
  <font face="Verdana">
  <head><meta charset="gb18030">
      <?php include('head.php');?>
      <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?> 
          <?php $pesquisa = $_GET['pesquisa'];
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
            <a>PRODUTOS</a>
          </h2>
          <div class="input-container">
                <input type=text id="pesquisa" size='500' value="<?php echo $pesquisa; ?>" onkeypress="enterProduto()">
                <i class="fa fa-search icon"></i>
              </div>
          <nav class="float-l">
                <?php
                $optipo = $optipo.$_SESSION['optipo'];
                if ($optipo == 'G') { ?>
                    <a href="cad_produto.php"><input type=image id="botao_novo" src="img/novo.png" style="margin-left:3px;" width="46" height="46"></a>
                    <input type=image id="botao_alterar" src="img/alterar.png" style="margin-left:3px;" width="46" height="46" onclick="alterarProduto()">
                    <input type=image id="botao_excluir" src="img/excluir.png" style="margin-left:3px;" width="46" height="46" onclick="excluirProduto()">
                <?php } ?>
          </nav>
	  </div>
      <!-- TABLE -->
        <table class="table table-action">

          <thead>
            <tr>
              <th class="t-very-small" style="display:none;">ID</th>
              <th class="t-very-small"></th>
              <th class="t-medium">PRODUTO</th>
              <th class="t-small">GRUPO</th>
              <th class="t-very-small">UM</th>
              <th class="t-small">VALOR</th>
              <th class="t-very-small">ESTOQUE</th>
            </tr>
          </thead>

          <tbody>
              <?php
              include('login/conexao.php');   
              
              $query = "SELECT procod, profcod, pronome, progrupo, proum, procusto, proval, progtin FROM tbpro
                        WHERE pronome like '%$pesquisa%' OR progrupo like '%$pesquisa%' LIMIT $limit_ini, $registros";
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
                      $estpro = $linhas['procod'];
                      $estfpro = $linhas['profcod'];
                      $progtin = $linhas['progtin'];
                      $query_sai = "select sum(tbsai.saiqtd) as saiqtd from tbsai inner join tbped on (tbsai.saiped = tbped.pedcod) where tbped.pedtipo = 1 and (tbped.pednfesit = 'APROVADO' or tbped.pednfesit = 'FATURADO') and (tbsai.saipro = '$estpro')";
                      $result_sai = mysqli_query($conexao, $query_sai) or die(mysqli_error());
                      $reg_sai = mysqli_num_rows($result_sai);
                      $linhas_sai = mysqli_fetch_assoc($result_sai);
                      $estsai = $linhas_sai['saiqtd'];
                        if (empty($estsai)) {
                            $estsai = 0;
                        }
                      $query_ent_xml = "select sum(tbsai.saiqtd) as saiqtd from tbsai inner join tbped on (tbsai.saiped = tbped.pedcod) where tbped.pedtipo = 0 and (tbped.pednfesit = 'APROVADO' or tbped.pednfesit = 'FATURADO' or tbped.pednfesit = 'APOIO' or tbped.pednfesit = 'RECEBIDO') and (tbsai.saipro = '$estfpro')";
                      $result_ent_xml = mysqli_query($conexao, $query_ent_xml) or die(mysqli_error());
                      $reg_ent_xml = mysqli_num_rows($result_ent_xml);
                      $linhas_ent_xml = mysqli_fetch_assoc($result_ent_xml);
                      $estent_xml = $linhas_ent_xml['saiqtd'];
                        if (empty($estent_xml)) {
                            $estent_xml = 0;
                        }
						
					  $query_ent = "select sum(tbsai.saiqtd) as saiqtd from tbsai inner join tbped on (tbsai.saiped = tbped.pedcod) where tbped.pedtipo = 0 and (tbped.pednfesit = 'APROVADO' or tbped.pednfesit = 'FATURADO' or tbped.pednfesit = 'APOIO' or tbped.pednfesit = 'RECEBIDO') and (tbsai.saipro = '$estpro')";
                      $result_ent = mysqli_query($conexao, $query_ent) or die(mysqli_error());
                      $reg_ent = mysqli_num_rows($result_ent);
                      $linhas_ent = mysqli_fetch_assoc($result_ent);
                      $estent = $linhas_ent['saiqtd'];
                        if (empty($estent)) {
                            $estent = 0;
                        }
                      $estqtd = ($estent+$estent_xml) - $estsai;
					  if ($dispositivo == 'mobile') {
							?>
							<tr>					
							  <td id="<?php echo $linhas['procod']?>" onclick="selecionaProduto(this)" style="display:none;"><?php echo $linhas['procod']?></td>
							  <td id="<?php echo $linhas['procod']?>F" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"></div>
								  <a href="#IMG<?php echo $linhas['procod']?>">
									<img src="img/visualizar.png">
								  </a>
								  <a href="#" class="lightbox" id="IMG<?php echo $linhas['procod']?>">
									<span style="background-image: url('img/prod/<?php echo $linhas['procod']?>.jpg')"></span>
								  </a>
							  </td>
							  <td id="<?php echo $linhas['procod']?>A" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"><b>NOME:</b></div><?php echo mb_strtoupper($linhas['pronome'])?></td>
							  <td id="<?php echo $linhas['procod']?>B" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"><b>GRUPO:</b></div><?php echo mb_strtoupper($linhas['progrupo'])?></td>
							  <td id="<?php echo $linhas['procod']?>C" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"><b>UM:</b></div><?php echo $linhas['proum']?></td>
							  <td id="<?php echo $linhas['procod']?>D" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"><b>PREÇO:</b></div><?php echo 'R$ '.number_format($linhas['proval'], 2, ',', '.')?></td>
							  <td id="<?php echo $linhas['procod']?>E" onclick="selecionaProduto(this)"><div style="display:inline-block;width:30%"><b>ESTOQUE:</b></div><?php echo $estqtd?></td> 						  
							</tr>
							<?php
						} else {
              ?>
                    <tr>
                      <td id="<?php echo $linhas['procod']?>" onclick="selecionaProduto(this)" style="display:none;"><?php echo $linhas['procod']?></td>
                      <td id="<?php echo $linhas['procod']?>F" onclick="selecionaProduto(this)">
                          <a href="#IMG<?php echo $linhas['procod']?>">
                            <img src="img/visualizar.png">
                          </a>
                          <a href="#" class="lightbox" id="IMG<?php echo $linhas['procod']?>">
                            <span style="background-image: url('img/prod/<?php echo $linhas['procod']?>.jpg')"></span>
                          </a>
                      </td>
                      <td id="<?php echo $linhas['procod']?>A" onclick="selecionaProduto(this)"><?php echo mb_strtoupper($linhas['pronome'])?></td>
                      <td id="<?php echo $linhas['procod']?>B" onclick="selecionaProduto(this)"><?php echo mb_strtoupper($linhas['progrupo'])?></td>
                      <td id="<?php echo $linhas['procod']?>C" onclick="selecionaProduto(this)"><?php echo $linhas['proum']?></td>
                      <td id="<?php echo $linhas['procod']?>D" onclick="selecionaProduto(this)"><?php echo 'R$ '.number_format($linhas['proval'], 2, ',', '.')?></td>
                      <td id="<?php echo $linhas['procod']?>E" onclick="selecionaProduto(this)"><?php echo $estqtd?></td>
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
							<a href="produtos.php?pagina=<?php echo $pagina-1; ?>" style="text-decoration:none;">								
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
						<a href="produtos.php?pagina=<?php echo $pagina+1; ?>" style="text-decoration:none;">
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