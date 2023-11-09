<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $pedcod = $_GET['pedcod']; ?>     
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
      
                  $query = "SELECT pedop, pedcli, pedfor, pedtipo FROM tbped WHERE pedcod = $pedcod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  $pedop = $linhas['pedop'];
		  $pedcli = $linhas['pedcli'];
                  $pedtipo = $linhas['pedtipo'];
 		  $pedfor = $linhas['pedfor'];
      
                  $query = "SELECT opnome FROM tbop WHERE opcod = $pedop";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  $opnome = $linhas['opnome'];

		  if($pedtipo == '1'){

		  	$query = "SELECT climail FROM tbcli WHERE clicod = $pedcli";
                  	$result = mysqli_query($conexao, $query) or die(mysqli_error());
                  	$reg = mysqli_num_rows($result);
                  	$linhas = mysqli_fetch_assoc($result);
                 	$forclimail = $linhas['climail'];

		  }else{

			$query = "SELECT formail FROM tbfor WHERE forcod = $pedfor";
                        $result = mysqli_query($conexao, $query) or die(mysqli_error());
                        $reg = mysqli_num_rows($result);
                        $linhas = mysqli_fetch_assoc($result);
                        $forclimail = $linhas['formail'];

		 }

      ?>
      <div class="cadastros">
          <center><h2>Envio do Pedido</h2></center><br> 
          <form method="POST" action="envia_pedido.php?opnome=<?php echo $opnome; ?>&pedcod=<?php echo $pedcod; ?>&empnome=<?php echo $empnome; ?>">
              <div class="label-float"><input type="email" id="email_dest" name="email_dest" value="<?php echo $forclimail; ?>" required><label>E-MAIL:</label></div>
              <input type="submit" id="submit_cadastros" value="ENVIAR">
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>
