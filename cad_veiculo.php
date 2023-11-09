<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $carcod = $_GET['carcod']; ?>
	  <?php if ($carcod == 'undefined') {
			header('Location: ./veiculos.php');
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
              if (empty($carcod)) {
                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT carcod, carmod, carfab, carplaca, carporte, caruf FROM tbcar WHERE carcod = $carcod";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $carmod = $linhas['carmod'];
                      $carfab = $linhas['carfab'];
                      $carplaca = $linhas['carplaca'];                      
                      $carporte = $linhas['carporte'];
                      $caruf = $linhas['caruf'];
                  } else {
                      $carmod = '';
                      $carfab = '';
                      $carplaca = '';                      
                      $carporte = '';
                      $caruf = '';
                  }
              }
      ?>
      <div class="cadastros">
          <center><h2>Cadastro de Veículo</h2></center><br> 
          <form name="form_cad_produto" method="POST" action="insert_veiculo.php?carcod=<?php echo $carcod ?>" autocomplete="off">
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="modelo_veiculo" name="carmod" value="<?php echo mb_strtoupper($carmod); ?>" required><label>MODELO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="fabricante_veiculo" name="carfab" value="<?php echo mb_strtoupper($carfab); ?>" required><label>FABRICANTE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="placa_veiculo" name="carplaca" value="<?php echo $carplaca; ?>" required><label>PLACA:</label></div>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;PORTE:</font></legend>
              <select id="porte_veiculo" name="carporte" style="width:290px;" onchange="habilitaBotao()" required>
                  <option><?php switch ($carporte) {
                            case 'PEQUENO':
                                echo "PEQUENO";
                                break;
                            case 'MEDIO':
                                echo "MÉDIO";
                                break;
                            case 'GRANDE':
                                echo "GRANDE";
                                break;
                           }?></option>
                  <option value="PEQUENO">PEQUENO</option>
                  <option value="MEDIO">MÉDIO</option>
                  <option value="GRANDE">GRANDE</option>
              </select>
              </fieldset></div>
              <div class="label-float">
              <fieldset>
                  <legend><font size="2px">&nbsp;UF:</font></legend>
              <select id="uf_veiculo" name="caruf" style="width:290px;" required>
                  <option><?php echo $caruf ?></option>
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