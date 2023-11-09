<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
	  <?php include('login/conexao.php');?>
	  <?php $pedcod = $_GET['pedcod']; ?>
	  <?php
		
		$query_tbemp = "SELECT empnfe FROM tbemp WHERE empcod = 1";
		$result_tbemp = mysqli_query($conexao, $query_tbemp) or die(mysqli_error());
		$reg_tbemp = mysqli_num_rows($result_tbemp);
		$linhas_tbemp = mysqli_fetch_assoc($result_tbemp);
		
		if ($linhas_tbemp['empnfe'] == 'NAO') {
			header('Location: fat_pedido.php?pedcod='.$pedcod);
		}
	  
		$query_verifica_emissores = "SELECT emissornome FROM tbemissor WHERE emissornome <> 'PRINCIPAL'";
		$result_verifica_emissores = mysqli_query($conexao, $query_verifica_emissores) or die(mysqli_error());
		$reg_verifica_emissores = mysqli_num_rows($result_verifica_emissores);
		$linhas_verifica_emissores = mysqli_fetch_assoc($result_verifica_emissores);
		
		if (empty($linhas_verifica_emissores['emissornome'])) {
			header('Location: fat_pedido.php?pedcod='.$pedcod);
		}
		
	  ?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>
		  <?php		  
		  $query = "SELECT empfant FROM tbemp WHERE empcod = 1";
		  $result = mysqli_query($conexao, $query) or die(mysqli_error());
		  $reg = mysqli_num_rows($result);
		  $linhas = mysqli_fetch_assoc($result);
		  $empfant = $linhas['empfant'];
		  
		  $query_emissores = "SELECT emissornome, emissordir FROM tbemissor WHERE emissornome <> 'PRINCIPAL'";
		  $result_emissores = mysqli_query($conexao, $query_emissores) or die(mysqli_error());
		  $reg_emissores = mysqli_num_rows($result_emissores);
		  $linhas_emissores = mysqli_fetch_assoc($result_emissores);
		  
		  ?>
      </header>
      <br><br><br>
      <div class="cadastros">
          <center><h2>Selecione o Emissor</h2></center><br> 
          <form method="POST" action="fat_pedido.php?pedcod=<?php echo $pedcod;?>" autocomplete="off">
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;EMISSORES:</font></legend>
              <select id="emissornome" name="emissornome" style="width:290px;" required>
                  <!-- <option value="PRINCIPAL"><?php /*echo mb_strtoupper($empfant); */?></option> -->
				  <?php
				  if($reg_emissores > 0) {
					// inicia o loop que vai mostrar todos os dados
					do { 
				  ?>
                  <option value="<?php echo $linhas_emissores['emissordir']; ?>"><?php echo mb_strtoupper($linhas_emissores['emissornome']); ?></option>
				  <?php
						}while($linhas_emissores = mysqli_fetch_assoc($result_emissores));
				  }
				  ?>
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