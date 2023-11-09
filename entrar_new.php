<html>
  <font face="Verdana">
  <head>
	  <?php include('head.php');?>      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>  
      <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />      
      
  </head>
  <body>
      <header>
          <?php include('header.php');?>      
      </header>
      <br><br><br>
      <div class="cadastros">
          <center><h2>Produto do Pedido</h2></center><br> 
          <form name="form_cad_produto_pedido" autocomplete="off">                                       
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;PRODUTO:</font>             
              <select id="select_produtos" name="select_cad_produto_pedido" onkeypress="habilitaBotao()" onchange="incluiProdutoPedido()">              
                  <option></option>
                <?php
                include('login/conexao.php');
                $query_email = "SELECT opmail FROM tbop";
                $result_email = mysqli_query($conexao, $query_email) or die(mysqli_error());
                $reg_email = mysqli_num_rows($result_email);
                $linhas_email = mysqli_fetch_assoc($result_email);
                   if($reg_email > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                        
                  ?>                  
                  <option><?php echo $linhas_email['opmail']?></option>
                   <?php
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas_email = mysqli_fetch_assoc($result_email));
                    // fim do if 
                    }              
                  ?> 
              </select>
              </fieldset></div>
        </form>
      </div>          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>
