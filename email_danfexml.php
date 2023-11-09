<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $pedcod = $_GET['pedcod'];?>
      
      <?php
      include('login/conexao.php'); 
      $query_tbped = "SELECT pedchave FROM tbped WHERE pedcod = $pedcod";
      $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
      $reg_tbped = mysqli_num_rows($result_tbped);
      $linhas_tbped = mysqli_fetch_assoc($result_tbped);
    
      if ($linhas_tbped['pedchave'] == ''){
      ?>
          <script type="text/javascript">
            var pedido = <?php echo $pedcod; ?>;
            window.location = "email_pedido.php?pedcod="+pedido;
          </script>
      <?php    
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
                  include('login/conexao.php');               
                  $query = "SELECT empfant FROM tbemp WHERE empcod = 1";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  $empnome = $linhas['empfant'];
      ?>
      <div class="cadastros">
          <center><h2>Envio do Pedido</h2></center><br> 
          <form method="POST" action="enviar_danfexml.php?pedcod=<?php echo $pedcod; ?>&empnome=<?php echo $empnome; ?>">
              <div class="label-float"><input type="email" id="email_dest" name="email_dest" value="" required><label>E-MAIL:</label></div>
              <input type="submit" id="submit_cadastros" value="ENVIAR">
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>