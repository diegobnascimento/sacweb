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
                        alert("Sem permissão de acesso a esse menu.");
                        window.location = "pedidos.php";
                      </script>';              
            } 
          ?>
      </header>
      <br><br><br>
      <?php          
                  include('login/conexao.php');               
                  $query = "SELECT empnome, empfant, empcnpj, empend, empnum, empbai, empie, empcid, empuf, emptel, empcep, empmail, empnfe FROM tbemp WHERE empcod = 1";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                      $empnome = $linhas['empnome'];
                      $empfant = $linhas['empfant'];
                      $empcnpj = $linhas['empcnpj'];
                      $empie = $linhas['empie'];
                      $empend = $linhas['empend'];
                      $empnum = $linhas['empnum'];
                      $empbai = $linhas['empbai'];
                      $empcep = $linhas['empcep'];
                      $empcid = $linhas['empcid'];
                      $empuf = $linhas['empuf'];
                      $emptel = $linhas['emptel'];
                      $empmail = $linhas['empmail'];
                      $empnfe = $linhas['empnfe'];
      ?>
      <div class="cadastros">
          <center><h2>Cadastro da Empresa</h2></center><br> 
          <form method="POST" action="alter_empresa.php" autocomplete="off">                             
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nome_empresa" name="empnome" value="<?php echo mb_strtoupper($empnome); ?>"><label>NOME:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nomefant_empresa" name="empfant" value="<?php echo mb_strtoupper($empfant); ?>" required><label>NOME FANTASIA:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cnpj_empresa" name="empcnpj" value="<?php echo $empcnpj; ?>" required><label>CNPJ:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="ie_empresa" name="empie" value="<?php echo $empie; ?>" required><label>IE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="end_empresa" name="empend" value="<?php echo mb_strtoupper($empend); ?>" required><label>ENDEREÇO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="num_empresa" name="empnum" value="<?php echo $empnum; ?>" required><label>NÚMERO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="bairro_empresa" name="empbai" value="<?php echo mb_strtoupper($empbai); ?>" required><label>BAIRRO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="cid_empresa" name="empcid" value="<?php echo mb_strtoupper($empcid); ?>" required><label>CIDADE:</label></div>
              <div class="label-float">
              <fieldset>
                  <legend><font size="2px">&nbsp;UF:</font></legend>
              <select id="uf_empresa" name="empuf" style="width:290px;" required>
                  <option><?php echo $empuf ?></option>
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
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cep_empresa" name="empcep" value="<?php echo $empcep; ?>" required><label>CEP:</label></div> 
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="tel_empresa" name="emptel" value="<?php echo $emptel; ?>"><label>TELEFONE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="email" id="mail_empresa" name="empmail" value="<?php echo $empmail; ?>"><label>E-MAIL:</label></div>            
              <div class="label-float">
              <fieldset>
                  <legend><font size="2px">&nbsp;NOTA FISCAL ELETRÔNICA:</font></legend>
              <select id="emite_nfe_empresa" name="empnfe" style="width:290px;" required>
                  <option><?php echo $empnfe ?></option>
                  <option>SIM</option>
                  <option>NAO</option>
              </select>
              </fieldset></div>
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