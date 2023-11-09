<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>
          <?php
            $optipo = $optipo.$_SESSION['optipo'];
            if ($optipo != 'G') {
                echo '<script>
                        window.location = "novo_pedido.php?tipo_pedido=VENDA";
                      </script>';              
            } 
          ?>
      </header>
      <br><br><br>
      <div class="cadastros">
          <center><h2>Novo Pedido</h2></center><br> 
          <form method="POST" action="novo_pedido.php" autocomplete="off">
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;TIPO DE PEDIDO:</font></legend>
              <select id="tipo_pedido" name="tipo_pedido" style="width:290px;" required>
                  <option value="VENDA">VENDA</option>
                  <option value="ENTRADA">ENTRADA</option>
              </select>
              </fieldset></div>
              <input type="submit" id="submit_cadastros" value="CONFIRMAR">
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>