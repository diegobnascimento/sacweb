<html>
  <font face="Verdana">
  <head>      
      <?php include('head.php');?>      
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>  
      <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
      <?php $saicod = $_GET['saicod']; ?>
      <?php $saiped = $_GET['saiped']; ?>      
      <?php if ($saicod == 'undefined') {
                if (!empty($saiped)) {		  
                    header('Location: ./produtos_pedido.php?pedcod='.$saiped);
	                exit();
				    }
                } ?>	  
      <?php $pesquisa = str_replace('%20', ' ', $_GET['pesquisa']); ?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>           
      </header>
      <br><br><br>
      <?php
              if (empty($saicod)) {
                  
                  include('login/conexao.php');
                  $query_tbped = "SELECT pedncli, pednfor, pedtot, pedtipo FROM tbped WHERE pedcod = $saiped";
                  $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
                  $reg_tbped = mysqli_num_rows($result_tbped);
                  $linhas_tbped = mysqli_fetch_assoc($result_tbped);
                  
                  if ($linhas_tbped['pedtipo'] == '0') {
                      $cli_for = 'FORNECEDOR';
                      $cli_for_nome = $linhas_tbped['pednfor'];
                  }else{
                      $cli_for = 'CLIENTE';
                      $cli_for_nome = $linhas_tbped['pedncli'];
                  }
                  
              } else {
                  include('login/conexao.php');
                  
                  $query = "SELECT saicod, saipro, sainpro, saium, saiqtd, saival, saitot, saigrupo FROM tbsai WHERE saicod = $saicod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $saipro = $linhas['saipro'];
                      $sainpro = $linhas['sainpro'];
                      $pesquisa = $linhas['saigrupo'];
                      $saium = $linhas['saium'];
                      $saiqtd = $linhas['saiqtd'];
                      $saival = $linhas['saival'];
                      $saitot = $linhas['saitot'];
                  } else {
                      $saipro = '';
                      $sainpro = '';
                      $saium = '';
                      $saiqtd = '';
                      $saival = '';
                      $saitot = '';   
                  }
                  $query_tbped = "SELECT pedncli, pednfor, pedtot, pedtipo FROM tbped WHERE pedcod = $saiped";
                  $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
                  $reg_tbped = mysqli_num_rows($result_tbped);
                  $linhas_tbped = mysqli_fetch_assoc($result_tbped);
                  
                  if ($linhas_tbped['pedtipo'] == '0') {
                      $cli_for = 'FORNECEDOR';
                      $cli_for_nome = $linhas_tbped['pednfor'];
                  }else{
                      $cli_for = 'CLIENTE';
                      $cli_for_nome = $linhas_tbped['pedncli'];
                  }
                  
                  
              }
      ?>
      <div class="cadastros">
          <center><h2>Produto do Pedido</h2></center><br> 
		  <a href="produtos_pedido.php?pedcod=<?php echo $saiped; ?>"><input type="button" id="submit_cadastros" value="FINALIZAR"></a>
          <form name="form_cad_produto_pedido" autocomplete="off">           
              <div class="label-float"><input type="text" id="pedido_produto" name="saiped" value="<?php echo $saiped; ?>" disabled><label>PEDIDO:</label></div>
              <div class="label-float"><input type="text" id="clifor_pedido" name="pedclifor" value="<?php echo $cli_for_nome; ?>" disabled><label><?php echo $cli_for; ?>:</label></div>
              <div class="label-float"><input type="text" id="total_pedido" name="pedtot" value="R$ <?php echo number_format($linhas_tbped['pedtot'], 2, ',', '.'); ?>" disabled><label>SUBTOTAL DO PEDIDO:</label></div>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;GRUPO:</font></legend>
              <?php
			 
              if (empty($saicod)){
              ?>
              <select id="select_grupos" name="select_cad_grupo_pedido" onkeypress="habilitaBotao()" onchange="pesquisaGrupo(<?php echo $saiped; ?>)">
              <?php 
              } else {
              ?> 
              <select id="select_grupos" name="select_cad_grupo_pedido" onkeypress="habilitaBotao()" onchange="pesquisaGrupo(<?php echo $saiped; ?>)" disabled>
              <?php
              }			  
			  ?>
					<option><?php echo $pesquisa ?></option>
					<option disabled></option>										
                <?php
				
				include('login/conexao.php');
                $query1 = "SELECT progrupo FROM tbpro where progrupo > '' group by progrupo;";
                $result1 = mysqli_query($conexao, $query1) or die(mysqli_error());
                $reg1 = mysqli_num_rows($result1);
                $linhas1 = mysqli_fetch_assoc($result1);
				$progrupo = $linhas1['progrupo'];
				
                   if($reg1 > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                        
					if ($pesquisa != $linhas1['progrupo']){
					  ?>                  
					  <option><?php echo $linhas1['progrupo']?></option>
					   <?php
					}
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas1 = mysqli_fetch_assoc($result1));
                    // fim do if 
                    }              
                  ?> 
				  <option>SEM GRUPO</option>
				  <option>TODOS</option>				 
              </select>
              </fieldset></div>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;PRODUTO:</font>
              <a href="#IMG<?php echo $saipro?>">
                <img src="img/visualizar.png">
              </a>
              <a href="#" class="lightbox" id="IMG<?php echo $saipro?>">
                <span id="imagem" style="background-image: url('img/prod/<?php echo $saipro?>.jpg')"></span>
              </a></legend>
              <?php 
              if (empty($saicod)){
              ?>
              <select id="select_produtos" name="select_cad_produto_pedido" onkeypress="habilitaBotao()" onchange="incluiProdutoPedido()">
              <?php 
              } else {
              ?>
              <select id="select_produtos" name="select_cad_produto_pedido" onkeypress="habilitaBotao()" onchange="incluiProdutoPedido()" disabled>
              <?php
              }
              ?>
                  <?php if (empty($saipro)) { 
                  $saiqtd = 1; ?>
                  <option></option>
                <?php } else { ?>
                <option>[<?php echo $saipro ?>] <?php echo mb_strtoupper($sainpro) ?> (<?php echo $saium ?> / <?php echo $saival ?>)</option>
                <option></option>
                <?php
                       } 
					   
				if (empty($pesquisa) || $pesquisa == 'undefined'){ ?>
					<option></option>
					<option disabled>SELECIONE UM GRUPO</option>
				<?php				
				} else {
                include('login/conexao.php');
				if ($pesquisa == 'TODOS'){
					$query2 = "SELECT procod, pronome, proum, proval FROM tbpro WHERE proval > 0";
				} else if ($pesquisa == 'SEM GRUPO'){
					$query2 = "SELECT procod, pronome, proum, proval FROM tbpro WHERE progrupo is null and proval > 0";
				} else {
					$query2 = "SELECT procod, pronome, proum, proval FROM tbpro WHERE progrupo = '$pesquisa' and proval > 0";
				}
				$result2 = mysqli_query($conexao, $query2) or die(mysqli_error());
				$reg2 = mysqli_num_rows($result2);
				$linhas2 = mysqli_fetch_assoc($result2);
				   if($reg2 > 0) {
					// inicia o loop que vai mostrar todos os dados
					do {                        
				  ?>                  
				  <option>[<?php echo $linhas2['procod']?>] <?php echo mb_strtoupper($linhas2['pronome'])?> (<?php echo $linhas2['proum']?> / <?php echo $linhas2['proval']?>)</option>
				   <?php
					// finaliza o loop que vai mostrar os dados
						}while($linhas2 = mysqli_fetch_assoc($result2));
					// fim do if 
					}
				}
			
				  ?> 
              </select>
              </fieldset></div>
              <div class="label-float"><input type="text" id="um_produto" name="saium" value="<?php echo $saium; ?>" disabled><label>UNIDADE DE MEDIDA:</label></div>
              <div class="label-float"><input type="text" id="valor_produto" name="saival" value="R$ <?php echo number_format($saival, 2, ',', '.'); ?>" onkeyup="calculaProdutoPreco()" onclick="seleciona_texto(this)"><label>VALOR:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="qtd_produto" name="saiqtd" value="<?php echo $saiqtd; ?>" onkeyup="calculaProduto()" onclick="seleciona_texto(this)"><label>QUANTIDADE:</label></div>
              <div class="label-float"><input type="text" id="total_produto" name="saitot" value="R$ <?php echo number_format($saitot, 2, ',', '.'); ?>" disabled><label>TOTAL DO PRODUTO:</label></div>
              <div class="label-float"></div>
              <input type="button" id="submit_cadastros" value="ADICIONAR" onclick="confirmaProdutoPedido(<?php echo $saicod; ?>)">              
        </form>
      </div>
  </body>      
  <footer>  
      <?php include('footer.php');?>
  </footer>
  </font>
</html>
