<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $clicod = $_GET['clicod']; ?>
	  <?php if ($clicod == 'undefined') {
				header('Location: ./clientes.php');
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
              if (empty($clicod)) {
                  
                  $clinome = $_GET['clinome'];
                  $clidoc = $_GET['clidoc'];
                  $cliie = $_GET['cliie'];
                  $cliend = $_GET['cliend'];
                  $clinum = $_GET['clinum'];
                  $clibai = $_GET['clibai'];
                  $clicid = $_GET['clicid'];
                  $cliuf = $_GET['cliuf'];
                  $clicep = $_GET['clicep'];
                  $climail = $_GET['climail'];
                  $clitel = $_GET['clitel'];
                  $clicel = $_GET['clicel'];
                  $cliobs1 = $_GET['cliobs1'];
                  $cliobs2 = $_GET['cliobs2'];
                  $cliobs3 = $_GET['cliobs3'];
                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT clicod, clinome, clidoc, cliie, cliend, clinum, clibai, clicid, cliuf, clicep, climail, clitel, clicel, cliobs1, cliobs2, cliobs3 
                  FROM tbcli WHERE clicod = $clicod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $clinome = $linhas['clinome'];
                      $clidoc = $linhas['clidoc'];
					  $clidoc = str_replace(".", "", $clidoc);
					  $clidoc = str_replace("/", "", $clidoc);
					  $clidoc = str_replace("-", "", $clidoc);
                      $cliie = $linhas['cliie'];
                      $cliend = $linhas['cliend'];
                      $clinum = $linhas['clinum'];
                      $clibai = $linhas['clibai'];
                      $clicid = $linhas['clicid'];
                      $cliuf = $linhas['cliuf'];
                      $clicep = $linhas['clicep'];
                      $climail = $linhas['climail'];
                      $clitel = $linhas['clitel'];
                      $clicel = $linhas['clicel'];
                      $cliobs1 = $linhas['cliobs1'];
                      $cliobs2 = $linhas['cliobs2'];
                      $cliobs3 = $linhas['cliobs3'];
                  } else {
                      $clinome = '';
                      $clidoc = '';
                      $cliie = '';
                      $cliend = '';
                      $clinum = '';
                      $clibai = '';
                      $clicid = '';
                      $cliuf = '';
                      $clicep = '';
                      $climail = '';
                      $clitel = '';
                      $clicel = '';
                      $cliobs1 = '';
                      $cliobs2 = '';
                      $cliobs3 = '';
                  }
              }
      ?>
      <div class="cadastros">
          <center><h2>Cadastro de Cliente</h2></center><br> 
          <form method="POST" action="insert_cliente.php?clicod=<?php echo $clicod ?>" autocomplete="off">                             
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nome_cliente" name="clinome" value="<?php echo mb_strtoupper($clinome); ?>" required><label>NOME:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="doc_cliente" name="clidoc" value="<?php echo $clidoc; ?>" required><label>CPF/CNPJ:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="ie_cliente" name="cliie" value="<?php echo $cliie; ?>"><label>IE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="end_cliente" name="cliend" value="<?php echo mb_strtoupper($cliend); ?>" required><label>ENDEREÇO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="num_cliente" name="clinum" value="<?php echo $clinum; ?>" required><label>NÚMERO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="bai_cliente" name="clibai" value="<?php echo mb_strtoupper($clibai); ?>" required><label>BAIRRO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="cid_cliente" name="clicid" value="<?php echo mb_strtoupper($clicid); ?>" required><label>CIDADE:</label></div>
              <div class="label-float">
              <fieldset>
                  <legend><font size="2px">&nbsp;UF:</font></legend>
              <select id="uf_cliente" name="cliuf" style="width:290px;" required>
                  <option><?php echo $cliuf ?></option>
                  <option>AC</option>
                  <option>AL</option>
                  <option>AP</option>
                  <option>AM</option>
                  <option>BA</option>
                  <option>CE</option>
                  <option>DF</option>
                  <option>ES</option>
                  <option>GO</option>
                  <option>MA</option>
                  <option>MT</option>
                  <option>MS</option>
                  <option>MG</option>
                  <option>PA</option>
                  <option>PB</option>
                  <option>PR</option>
                  <option>PE</option>
                  <option>PI</option>
                  <option>RJ</option>
                  <option>RN</option>
                  <option>RS</option>
                  <option>RO</option>
                  <option>RR</option>
                  <option>SC</option>
                  <option>SP</option>
                  <option>SE</option>
                  <option>TO</option>
              </select>
              </fieldset></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cep_cliente" name="clicep" value="<?php echo $clicep; ?>" required><label>CEP:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="email" id="mail_cliente" name="climail" value="<?php echo $climail; ?>"><label>EMAIL:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="tel_cliente" name="clitel" value="<?php echo $clitel; ?>"><label>TELEFONE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cel_cliente" name="clicel" value="<?php echo $clicel; ?>"><label>CELULAR:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs1_cliente" name="cliobs1" value="<?php echo mb_strtoupper($cliobs1); ?>"><label>OBSERVAÇÃO 1:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs2_cliente" name="cliobs2" value="<?php echo mb_strtoupper($cliobs2); ?>"><label>OBSERVAÇÃO 2:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs3_cliente" name="cliobs3" value="<?php echo mb_strtoupper($cliobs3); ?>"><label>OBSERVAÇÃO 3:</label></div>
              <div class="label-float"></div>
              <input type="submit" id="submit_cadastros" value="CONFIRMAR"><br><br><br><br>
			  <center><input type="button" onclick="ConfirmaUnificar(<?php echo $clicod?>)" value="UNIFICAR FATURAMENTO PENDENTE"></center>
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>