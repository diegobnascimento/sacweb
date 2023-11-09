<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $opcod = $_GET['opcod']; ?>
	  <?php if ($opcod == 'undefined') {
			header('Location: ./vendedores.php');
			exit();
		} ?>
  </head>
  <body>
      <header>
          <?php include('header.php');?>
          <?php include('menu.php');?>		   
      </header>
      <br><br><br>
      <?php
              if (empty($opcod)) {
                   $optipo = 'COMUM';
                   $optipo2 = 'GERENTE';                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT opcod, opnome, opsenha, opmail, opcel, opreg, optipo FROM tbop WHERE opcod = $opcod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $opnome = $linhas['opnome'];
                      $opsenha = $linhas['opsenha'];
                      $opmail = $linhas['opmail'];
                      $opcel = $linhas['opcel'];
                      $opreg = $linhas['opreg'];
                      $optipo = $linhas['optipo'];
                      
                      if ($optipo == 'V') {
                            $optipo = 'COMUM';
                            $optipo2 = 'GERENTE';
                        } else {
                            $optipo = 'GERENTE';
                            $optipo2 = 'COMUM';
                        }
                                      } else {
                      $opnome = '';
                      $opsenha = '';
                      $opmail = '';
                      $opcel = '';
                      $opreg = '';                     
                  }
              }
      ?>
      <div class="cadastros">
          <center><h2>Cadastro de Vendedor</h2></center><br> 
          <form method="POST" action="insert_vendedor.php?opcod=<?php echo $opcod ?>" autocomplete="off">                             
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nome_vendedor" name="opnome" value="<?php echo mb_strtoupper($opnome); ?>" required><label>NOME:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="email" id="mail_vendedor" name="opmail" value="<?php echo $opmail; ?>" required><label>E-MAIL:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="password" id="senha_vendedor" name="opsenha" value="<?php echo $opsenha; ?>" required><label>SENHA:</label></div>            
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cel_vendedor" name="opcel" value="<?php echo $opcel; ?>"><label>CELULAR:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="reg_vendedor" name="opreg" value="<?php echo mb_strtoupper($opreg); ?>"><label>REGIÃO:</label></div> 
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;PERFIL:</font></legend>
              <select name='select_perfil' onchange="habilitaBotao()" style="width:290px;" required>
                  <option value='<?php echo $optipo ?>'><?php echo $optipo ?></option>
                  <option value='<?php echo $optipo2 ?>'><?php echo $optipo2 ?></option>
              </select>
              </fieldset></div>
              <div class="label-float"><input type="submit" id="submit_cadastros" value="CONFIRMAR">              
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>