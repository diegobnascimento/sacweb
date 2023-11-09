<html>
  <font face="Verdana">
  <head>
	  <?php include('head.php');?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>      
      <?php $pedcod = $_GET['pedcod']; ?>
      <?php $tipo_pedido = $_POST['tipo_pedido']; 
      if ($tipo_pedido == ''){
          $tipo_pedido = $_GET['tipo_pedido'];
      }
      ?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>           
      </header>
      <br><br><br>
      <?php
              if (empty($pedcod)) {
                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT pedcod, pedcli, pedncli, pedop, pednop, pedtot, pedtipo FROM tbped WHERE pedcod = $pedcod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      if ($tipo_pedido == 'VENDA'){
                        $pedcli = $linhas['pedcli'];
                        $pedncli = $linhas['pedncli'];                      
                      }else{
                        $pedfor = $linhas['pedfor'];
                        $pednfor = $linhas['pednfor'];                      
                      }
                  } else {
                       if ($tipo_pedido == 'VENDA'){
                        $pedcli = $linhas['pedcli'];
                        $pedncli = $linhas['pedncli'];                      
                      }else{
                        $pedfor = $linhas['pedfor'];
                        $pednfor = $linhas['pednfor'];                      
                      }
                  }
              }
      ?>
      <div class="cadastros">
          <?php
          if ($tipo_pedido == 'VENDA'){
            ?><center><h2>Cliente do Pedido</h2></center><br><?php                      
          }else{
            ?><center><h2>Fornecedor do Pedido</h2></center><br><?php                      
          }
          ?>
          <form name="form_cad_pedido">		  
              <?php
              if ($tipo_pedido == 'VENDA' || $tipo_pedido == 'UNIFICADO'){
              ?>				
                <div class="label-float"><fieldset><legend><font size="2px">&nbsp;CLIENTE:</font></legend>
                <select id="select_clientes" name="select_cad_pedido" onchange="selecionaClientePedido()"> 
                <option></option>
                <?php
                include('login/conexao.php');
                $query2 = "SELECT clicod, clinome FROM tbcli";
                $result2 = mysqli_query($conexao, $query2) or die(mysqli_error());
                $reg2 = mysqli_num_rows($result2);
                $linhas2 = mysqli_fetch_assoc($result2);
                   if($reg2 > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                    
                  ?>
                  <option><?php echo $linhas2['clicod']?> - <?php echo mb_strtoupper($linhas2['clinome'])?></option>
                   <?php
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas2 = mysqli_fetch_assoc($result2));
                    // fim do if 
                    }              
                  ?> 
              </select>
              </fieldset></div>
              <div class="label-float"></div>			  
			  <input type="button" id="submit_cadastros" value="CONFIRMAR" onclick="confirmaClientePedido()" disabled>			  
              </form>
              <?php                      
              }else{
                ?>
                <div class="label-float"><fieldset><legend><font size="2px">&nbsp;FORNECEDOR:</font></legend>
                <select id="select_fornecedores" name="select_cad_pedido" onchange="selecionaFornecedorPedido()"> 
                <option></option>
                <?php
                include('login/conexao.php');
                $query2 = "SELECT forcod, fornome FROM tbfor";
                $result2 = mysqli_query($conexao, $query2) or die(mysqli_error());
                $reg2 = mysqli_num_rows($result2);
                $linhas2 = mysqli_fetch_assoc($result2);
                   if($reg2 > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                    
                  ?>
                  <option><?php echo $linhas2['forcod']?> - <?php echo mb_strtoupper($linhas2['fornome'])?></option>
                   <?php
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas2 = mysqli_fetch_assoc($result2));
                    // fim do if 
                    }              
                  ?> 
              </select>
              </fieldset></div>
              <input type="button" id="submit_cadastros" value="CONFIRMAR" onclick="confirmaFornecedorPedido()" disabled>
              </form>
              <div class="label-float"></div>
              <form action="xml_upload.php" method="post" enctype="multipart/form-data">
                  <span class="btn btn-success fileinput-button">
                  <span>SELECIONAR ARQUIVO XML...</span>
                  <input type="file" name="arquivo" accept=".xml" onchange="habilitaImportar()">
                  </span>
                  <a href="import_xml.php"><input type="submit" id="botao_importar" value="IMPORTAR XML" disabled></a>
              </form>
              <?php                      
              }
              ?>
      </div>
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>