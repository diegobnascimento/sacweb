<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $forcod = $_GET['forcod']; ?>
	  <?php if ($forcod == 'undefined') {
				header('Location: ./fornecedores.php');
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
              if (empty($forcod)) {
                  
                  $fornome = $_GET['fornome'];
                  $fordoc = $_GET['fordoc'];
                  $forie = $_GET['forie'];
                  $forend = $_GET['forend'];
                  $fornum = $_GET['fornum'];
                  $forbai = $_GET['forbai'];
                  $forcid = $_GET['forcid'];
                  $foruf = $_GET['foruf'];
                  $forcep = $_GET['forcep'];
                  $formail = $_GET['formail'];
                  $fortel = $_GET['fortel'];
                  $forcel = $_GET['forcel'];
                  $forobs1 = $_GET['forobs1'];
                  $forobs2 = $_GET['forobs2'];
                  $forobs3 = $_GET['forobs3'];
                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT forcod, fornome, fordoc, forie, forend, fornum, forbai, forcid, foruf, forcep, formail, fortel, forcel, forobs1, forobs2, forobs3 
                  FROM tbfor WHERE forcod = $forcod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $fornome = $linhas['fornome'];
                      $fordoc = $linhas['fordoc'];
                      $forie = $linhas['forie'];
                      $forend = $linhas['forend'];
                      $fornum = $linhas['fornum'];
                      $forbai = $linhas['forbai'];
                      $forcid = $linhas['forcid'];
                      $foruf = $linhas['foruf'];
                      $forcep = $linhas['forcep'];
                      $formail = $linhas['formail'];
                      $fortel = $linhas['fortel'];
                      $forcel = $linhas['forcel'];
                      $forobs1 = $linhas['forobs1'];
                      $forobs2 = $linhas['forobs2'];
                      $forobs3 = $linhas['forobs3'];
                  } else {
                      $fornome = '';
                      $fordoc = '';
                      $forie = '';
                      $forend = '';
                      $fornum = '';
                      $forbai = '';
                      $forcid = '';
                      $foruf = '';
                      $forcep = '';
                      $formail = '';
                      $fortel = '';
                      $forcel = '';
                      $forobs1 = '';
                      $forobs2 = '';
                      $forobs3 = '';
                  }
              }
      ?>
      <div class="cadastros">
          <center><h2>Cadastro de Fornecedor</h2></center><br> 
          <form method="POST" action="insert_fornecedor.php?forcod=<?php echo $forcod ?>" autocomplete="off">                             
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nome_fornecedor" name="fornome" value="<?php echo mb_strtoupper($fornome); ?>" required><label>NOME:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="doc_fornecedor" name="fordoc" value="<?php echo $fordoc; ?>" required><label>CPF/CNPJ:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="ie_fornecedor" name="forie" value="<?php echo $forie; ?>"><label>IE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="end_fornecedor" name="forend" value="<?php echo mb_strtoupper($forend); ?>" required><label>ENDEREÇO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="num_fornecedor" name="fornum" value="<?php echo $fornum; ?>" required><label>NÚMERO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="bai_fornecedor" name="forbai" value="<?php echo mb_strtoupper($forbai); ?>" required><label>BAIRRO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="cid_fornecedor" name="forcid" value="<?php echo mb_strtoupper($forcid); ?>" required><label>CIDADE:</label></div>
              <div class="label-float">
              <fieldset>
                  <legend><font size="2px">&nbsp;UF:</font></legend>
              <select id="uf_fornecedor" name="foruf" style="width:290px;" required>
                  <option><?php echo $foruf ?></option>
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
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cep_fornecedor" name="forcep" value="<?php echo $forcep; ?>" required><label>CEP:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="email" id="mail_fornecedor" name="formail" value="<?php echo $formail; ?>"><label>EMAIL:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="tel_fornecedor" name="fortel" value="<?php echo $fortel; ?>"><label>TELEFONE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cel_fornecedor" name="forcel" value="<?php echo $forcel; ?>"><label>CELULAR:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs1_fornecedor" name="forobs1" value="<?php echo mb_strtoupper($forobs1); ?>"><label>OBSERVAÇÃO 1:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs2_fornecedor" name="forobs2" value="<?php echo mb_strtoupper($forobs2); ?>"><label>OBSERVAÇÃO 2:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="obs3_fornecedor" name="forobs3" value="<?php echo mb_strtoupper($forobs3); ?>"><label>OBSERVAÇÃO 3:</label></div>
              <div class="label-float"></div>
              <input type="submit" id="submit_cadastros" value="CONFIRMAR">
        </form>
      </div>
          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>