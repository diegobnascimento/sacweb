<html>
  <font face="Verdana">
  <head>
      <?php include('head.php');?>
      <?php $procod = $_GET['procod']; ?>
	  <?php if ($procod == 'undefined') {
				header('Location: ./produtos.php');
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
      include('login/conexao.php');
      $query_tbemp = "SELECT empnfe FROM tbemp WHERE empcod = 1";
      $result_tbemp = mysqli_query($conexao, $query_tbemp) or die(mysqli_error());
      $reg_tbemp = mysqli_num_rows($result_tbemp);
      $linhas_tbemp = mysqli_fetch_assoc($result_tbemp);
      
              if (empty($procod)) {
                  
              } else {
                  include('login/conexao.php');               
                  $query = "SELECT procod, pronome, proum, proval, procusto, progtin, proncm, procest, procst, proalqicms, proipi, proalqipi, procstpis, proalqpis, procstcof, proalqcof, progrupo, propeso, procfopent, procfopsai, proenquad, proorig FROM tbpro WHERE procod = '$procod'";
                  $result = mysqli_query($conexao, $query) or die(mysqli_error());
                  $reg = mysqli_num_rows($result);
                  $linhas = mysqli_fetch_assoc($result);
                  if ($reg > 0){
                      $pronome = $linhas['pronome'];
                      $proum = $linhas['proum'];
                      $proval = $linhas['proval'];
                      $procusto = $linhas['procusto'];
                      $progtin = $linhas['progtin'];
                      $proncm = $linhas['proncm'];
                      $procest = $linhas['procest'];
                      $proicms = $linhas['procst'];
                      $proalqicms = $linhas['proalqicms'];
                      $proipi = $linhas['proipi'];
                      $proalqipi = $linhas['proalqipi'];
                      $propis = $linhas['procstpis'];
                      $proalqpis = $linhas['proalqpis'];
                      $procof = $linhas['procstcof'];
                      $proalqcof = $linhas['proalqcof'];
                      $progrupo = $linhas['progrupo'];
                      $propeso = $linhas['propeso'];
                      $procfopent = $linhas['procfopent'];
                      $procfopsai = $linhas['procfopsai'];
                      $proorig = $linhas['proorig'];
                      $proenquad = $linhas['proenquad'];
                  } else {
                      $pronome = '';
                      $proum = '';
                      $proval = '';
                      $procusto = '';
                      $progtin = '';
                      $proncm = '';
                      $procest = '';
                      $proicms = '';
                      $proalqicms = '';
                      $propis = '';
                      $proalqpis = '';
                      $procof = '';
                      $proalqcof = '';
                      $progrupo = '';
                      $propeso = '';
                      $procfopent = '';
                      $procfopsai = '';
                      $proorig = '';
                      $proenquad = '';
                  }
              }
      ?>
      <div class="cadastros">
          <center><h2>Cadastro de Produto</h2></center><br>
          <form name="form_cad_produto" method="POST" action="insert_produto.php?procod=<?php echo $procod ?>" autocomplete="off"  enctype="multipart/form-data">
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="nome_produto" name="pronome" value="<?php echo mb_strtoupper($pronome); ?>" required><label>NOME:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="um_produto" name="proum" value="<?php echo $proum; ?>" required><label>UNIDADE DE MEDIDA:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="peso_produto" name="propeso" value="<?php echo $propeso; ?>" required><label>PESO (KG):</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="grupo_produto" name="progrupo" value="<?php echo mb_strtoupper($progrupo); ?>"><label>GRUPO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="gtin_produto" name="progtin" value="<?php echo $progtin; ?>" required><label>CÓDIGO DE BARRAS:</label></div>
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM') {
              ?>
                  <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="ncm_produto" name="proncm" value="<?php echo $proncm; ?>"><label>NCM:</label></div>
                  <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="cest_produto" name="procest" value="<?php echo $procest; ?>"><label>CEST:</label></div>
                  <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="cfopent_produto" name="procfopent" value="<?php echo $procfopent; ?>" required><label>CFOP ENTRADA:</label></div>
                  <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="cfopsai_produto" name="procfopsai" value="<?php echo $procfopsai; ?>" required><label>CFOP SAÍDA:</label></div>
              <?php
              }
              ?>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="custo_produto" name="procusto" value="<?php echo number_format($procusto, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>VALOR DE CUSTO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="valor_produto" name="proval" value="<?php echo number_format($proval, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>VALOR DE VENDA:</label></div>
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM') {
              ?>
                  <div class="label-float"><fieldset><legend><font size="2px">&nbsp;ORIGEM:</font></legend>
                  <select id="origem_produto" name="proorig" style="width:290px;" onchange="habilitaBotao()">
                      <option><?php switch ($proorig) {
                                case '0':
                                    echo "0 - Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8";
                                    break;
                                case '1':
                                    echo "1 - Estrangeira - Importação direta, exceto a indicada no código 6";
                                    break;
                                case '2':
                                    echo "2 - Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7";
                                    break;
                                case '3':
                                    echo "3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% e inferior ou igual a 70%";
                                    break;
                                case '4':
                                    echo "4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes";
                                    break;
                                case '5':
                                    echo "5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%";
                                    break;
                                case '6':
                                    echo "6 - Estrangeira - Importação direta, sem similar nacional, constante em lista da CAMEX e gás natural";
                                    break;
                                case '7':
                                    echo "7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante lista CAMEX e gás natural";
                                    break;
                                case '8':
                                    echo "8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70%";
                                    break;
                            }?></option>
                      <option value="0">0 - Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8</option>
                      <option value="1">1 - Estrangeira - Importação direta, exceto a indicada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;no código 6</option> 
                      <option value="2">2 - Estrangeira - Adquirida no mercado interno, exceto a </option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;indicada no código 7</option> 
                      <option value="3">3 - Nacional, mercadoria ou bem com Conteúdo de Importação</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;superior a 40% e inferior ou igual a 70%</option> 
                      <option value="4">4 - Nacional, cuja produção tenha sido feita em conformidade</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;com os processos produtivos básicos de</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;que tratam as legislações citadas nos Ajustes</option> 
                      <option value="5">5 - Nacional, mercadoria ou bem com Conteúdo de Importação</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inferior ou igual a 40%</option> 
                      <option value="6">6 - Estrangeira - Importação direta, sem similar nacional,</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;constante em lista da CAMEX e gás natural</option>
                      <option value="7">7 - Estrangeira - Adquirida no mercado interno, sem similar</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nacional, constante lista CAMEX e gás natural</option>
                      <option value="8">8 - Nacional, mercadoria ou bem com Conteúdo de Importação</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;superior a 70%</option>
                  </select>
                  </fieldset></div>
                  <div class="label-float"><fieldset><legend><font size="2px">&nbsp;CST ICMS:</font></legend>
                  <select id="icms_produto" name="procst" style="width:290px;" onchange="habilitaBotao()">
                      <option><?php switch ($proicms) {
                                case '00':
                                    echo "00 - Tributada integralmente";
                                    break;
                                case '10':
                                    echo "10 - Tributada e com cobrança do ICMS por substituição tributária";
                                    break;
                                case '20':
                                    echo "20 - Com redução da BC";
                                    break;
                                case '30':
                                    echo "30 - Isenta / não tributada e com cobrança do ICMS por substituição tributária";
                                    break;
                                case '40':
                                    echo "40 - Isenta";
                                    break;
                                case '41':
                                    echo "20 - Com redução da BC";
                                    break;
                                case '50':
                                    echo "50 - Com suspensão";
                                    break;
                                case '51':
                                    echo "51 - Com diferimento";
                                    break;
                                case '60':
                                    echo "60 - ICMS cobrado anteriormente por substituição tributária";
                                    break;
                                case '70':
                                    echo "70 - Com redução da BC e cobrança do ICMS por substituição tributária";
                                    break;
                                case '90':
                                    echo "90 - Outras";
                                    break;
                                case '101':
                                    echo "101 - Tributada pelo Simples Nacional com permissão de crédito";
                                    break;
                                case '102':
                                    echo "102 - Tributada pelo Simples Nacional sem permissão de crédito";
                                    break;
                                case '103':
                                    echo "103 - Isenção do ICMS no Simples Nacional para faixa de receita bruta";
                                    break;
                                case '201':
                                    echo "201 - Tributada pelo Simples Nacional com permissão de crédito e com cobrança do ICMS por substituição tributária";
                                    break;
                                case '202':
                                    echo "202 - Tributada pelo Simples Nacional sem permissão de crédito e com cobrança do ICMS por substituição tributária";
                                    break;
                                case '203':
                                    echo "203 - Isenção do ICMS no Simples Nacional para faixa de receita bruta e com cobrança do ICMS por substituição tributária";
                                    break;
                                case '300':
                                    echo "300 - Imune";
                                    break;
                                case '400':
                                    echo "400 - Não tributada pelo Simples Nacional";
                                    break;
                                case '500':
                                    echo "500 - ICMS cobrado anteriormente por substituição tributária (substituído) ou por antecipação";
                                    break;
                                case '900':
                                    echo "900 - Outros";
                                    break;
                            }?></option>
                      <option value="00">00 - Tributada integralmente</option>
                      <option value="10">10 - Tributada e com cobrança do ICMS por substituição tributária</option>
                      <option value="20">20 - Com redução da BC</option>
                      <option value="30">30 - Isenta / não tributada e com cobrança do ICMS por substituição</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tributária</option> 
                      <option value="40">40 - Isenta</option>
                      <option value="41">41 - Não tributada</option>
                      <option value="50">50 - Com suspensão</option>
                      <option value="51">51 - Com diferimento</option>
                      <option value="60">60 - ICMS cobrado anteriormente por substituição tributária</option>
                      <option value="70">70 - Com redução da BC e cobrança do ICMS por substituição tributária</option>
                      <option value="90">90 - Outras</option>
                      <option value="101">101 - Tributada pelo Simples Nacional com permissão de crédito</option>
                      <option value="102">102 - Tributada pelo Simples Nacional sem permissão de crédito</option>
                      <option value="103">103 - Isenção do ICMS no Simples Nacional para faixa de receita bruta</option>
                      <option value="201">201 - Tributada pelo Simples Nacional com permissão de crédito e com</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cobrança do ICMS por substituição tributária</option> 
                      <option value="202">202 - Tributada pelo Simples Nacional sem permissão de crédito e com</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cobrança do ICMS por substituição tributária</option> 
                      <option value="203">203 - Isenção do ICMS no Simples Nacional para faixa de receita bruta</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e com cobrança do ICMS por substituição tributária</option> 
                      <option value="300">300 - Imune</option>
                      <option value="400">400 - Não tributada pelo Simples Nacional</option>
                      <option value="500">500 - ICMS cobrado anteriormente por substituição tributária</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(substituído) ou por antecipação</option> 
                      <option value="900">900 - Outros</option>
                  </select>
                  </fieldset></div>
                  <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="alqicms_produto" name="proalqicms" value="<?php echo number_format($proalqicms, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>ALÍQUOTA ICMS:</label></div>
                  <div class="label-float"><fieldset><legend><font size="2px">&nbsp;CST IPI:</font></legend>
                  <select id="ipi_produto" name="proipi" style="width:290px;" onchange="habilitaBotao()">
                      <option><?php switch ($proipi) {
                                case '00':
                                    echo "00 - Entrada com Recuperação de Crédito";
                                    break;
                                case '01':
                                    echo "01 - Entrada Tributável com Alíquota Zero";
                                    break;
                                case '02':
                                    echo "02 - Entrada Isenta";
                                    break;
                                case '03':
                                    echo "03 - Entrada Não-Tributada";
                                    break;
                                case '04':
                                    echo "04 - Entrada Imune";
                                    break;
                                case '05':
                                    echo "05 - Entrada com Suspensão";
                                    break;
                                case '49':
                                    echo "49 - Outras Entradas";
                                    break;
                                case '50':
                                    echo "50 - Saída Tributada";
                                    break;
                                case '51':
                                    echo "51 - Saída Tributável com Alíquota Zero";
                                    break;
                                case '52':
                                    echo "52 - Saída Isenta";
                                    break;
                                case '53':
                                    echo "53 - Saída Não-Tributada";
                                    break;
                                case '54':
                                    echo "54 - Saída Imune";
                                    break;
                                case '55':
                                    echo "55 - Saída com Suspensão";
                                    break;
                                case '99':
                                    echo "99 - Outras Saídas";
                                    break;
                            }?></option>
                      <option value="00">00 - Entrada com Recuperação de Crédito</option>
                      <option value="01">01 - Entrada Tributável com Alíquota Zero</option>
                      <option value="02">02 - Entrada Isenta</option>
                      <option value="03">03 - Entrada Não-Tributada</option>
                      <option value="04">04 - Entrada Imune</option>
                      <option value="05">05 - Entrada com Suspensão</option>
                      <option value="49">49 - Outras Entradas</option>
                      <option value="50">50 - Saída Tributada</option>
                      <option value="51">51 - Saída Tributável com Alíquota Zero</option>
                      <option value="52">52 - Saída Isenta</option>
                      <option value="53">53 - Saída Não-Tributada</option>
                      <option value="54">54 - Saída Imune</option>
                      <option value="55">55 - Saída com Suspensão</option>
                      <option value="99">99 - Outras Saídas</option>        
                  </select>
                  </fieldset></div>
                  <div class="label-float"><p><input onkeypress="habilitaBotao()" type="text" id="alqipi_produto" name="proalqipi" value="<?php echo number_format($proalqipi, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>ALQÍQUOTA IPI:</label></p></div>
                  <div class="label-float"><p><input onkeypress="habilitaBotao()" type="number" id="enquadipi_produto" name="proenquad" value="<?php echo $proenquad; ?>" ><label>ENQUADRAMENTO IPI:</label></p></div>
                  <div class="label-float"><fieldset><legend><font size="2px">&nbsp;CST PIS:</font></legend>
                  <select id="pis_produto" name="procstpis" style="width:290px;" onchange="habilitaBotao()">
                      <option><?php switch ($propis) {
                                case '01':
                                    echo "01 - Operação Tributável com Alíquota Básica";
                                    break;
                                case '02':
                                    echo "02 - Operação Tributável com Alíquota Diferenciada";
                                    break;
                                case '03':
                                    echo "03 - Operação Tributável com Alíquota por Unidade de Medida";
                                    break;
                                case '04':
                                    echo "04 - Operação Tributável Monofásica - Revenda a Alíquota Zero";
                                    break;
                                case '05':
                                    echo "05 - Operação Tributável por Substituição Tributária";
                                    break;
                                case '06':
                                    echo "06 - Operação Tributável a Alíquota Zero";
                                    break;
                                case '07':
                                    echo "07 - Operação Isenta da Contribuição";
                                    break;
                                case '08':
                                    echo "08 - Operação sem Incidência da Contribuição";
                                    break;
                                case '09':
                                    echo "09 - Operação com Suspensão da Contribuição";
                                    break;
                                case '49':
                                    echo "49 - Outras Operações de Saída";
                                    break;
                                case '50':
                                    echo "50 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '51':
                                    echo "51 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '52':
                                    echo "52 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '53':
                                    echo "53 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '54':
                                    echo "54 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '55':
                                    echo "55 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '56':
                                    echo "56 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '60':
                                    echo "60 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '61':
                                    echo "61 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '62':
                                    echo "62 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '63':
                                    echo "63 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '64':
                                    echo "64 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '65':
                                    echo "65 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '66':
                                    echo "66 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '67':
                                    echo "67 - Crédito Presumido - Outras Operações";
                                    break;
                                case '70':
                                    echo "70 - Operação de Aquisição sem Direito a Crédito";
                                    break;
                                case '71':
                                    echo "71 - Operação de Aquisição com Isenção";
                                    break;
                                case '72':
                                    echo "72 - Operação de Aquisição com Suspensão";
                                    break;
                                case '73':
                                    echo "73 - Operação de Aquisição a Alíquota Zero";
                                    break;
                                case '74':
                                    echo "74 - Operação de Aquisição sem Incidência da Contribuição";
                                    break;
                                case '75':
                                    echo "75 - Operação de Aquisição por Substituição Tributária";
                                    break;
                                case '98':
                                    echo "98 - Outras Operações de Entrada";
                                    break;
                                case '99':
                                    echo "99 - Outras Operações";
                                    break;
                            }?></option>
                      <option value="01"> 01 - Operação Tributável com Alíquota Básica</option>
                      <option value="02"> 02 - Operação Tributável com Alíquota Diferenciada</option>
                      <option value="03"> 03 - Operação Tributável com Alíquota por Unidade de Medida</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Produto</option> 
                      <option value="04"> 04 - Operação Tributável Monofásica - Revenda a Alíquota Zero</option>
                      <option value="05"> 05 - Operação Tributável por Substituição Tributária</option>
                      <option value="06"> 06 - Operação Tributável a Alíquota Zero</option>
                      <option value="07"> 07 - Operação Isenta da Contribuição</option>
                      <option value="08"> 08 - Operação sem Incidência da Contribuição</option>
                      <option value="09"> 09 - Operação com Suspensão da Contribuição</option>
                      <option value="49"> 49 - Outras Operações de Saída</option>
                      <option value="50"> 50 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita Tributada no Mercado Interno</option> 
                      <option value="51"> 51 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita Não-Tributada no Mercado Interno</option> 
                      <option value="52"> 52 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita de Exportação</option> 
                      <option value="53"> 53 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="54"> 54 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="55"> 55 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Não Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="56"> 56 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno e</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Exportação</option> 
                      <option value="60"> 60 - Crédito Presumido - Operação de Aquisição Vinculada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita Tributada no Mercado Interno</option> 
                      <option value="61"> 61 - Crédito Presumido - Operação de Aquisição Vinculada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita Não-Tributada no Mercado Interno</option> 
                      <option value="62"> 62 - Crédito Presumido - Operação de Aquisição Vinculada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita de Exportação</option> 
                      <option value="63"> 63 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="64"> 64 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="65"> 65 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Não-Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="66"> 66 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas e Não-Tributadas no Mercado Interno e</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Exportação</option> 
                      <option value="67"> 67 - Crédito Presumido - Outras Operações</option>
                      <option value="70"> 70 - Operação de Aquisição sem Direito a Crédito</option>
                      <option value="71"> 71 - Operação de Aquisição com Isenção</option>
                      <option value="72"> 72 - Operação de Aquisição com Suspensão</option>
                      <option value="73"> 73 - Operação de Aquisição a Alíquota Zero</option>
                      <option value="74"> 74 - Operação de Aquisição sem Incidência da Contribuição</option>
                      <option value="75"> 75 - Operação de Aquisição por Substituição Tributária</option>
                      <option value="98"> 98 - Outras Operações de Entrada</option>
                      <option value="99"> 99 - Outras Operações</option>
                  </select>
                  </fieldset></div>
                  <div class="label-float"><p><input onkeypress="habilitaBotao()" type="text" id="alqpis_produto" name="proalqpis" value="<?php echo number_format($proalqpis, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>ALÍQUOTA PIS:</label></p></div>
                  <div class="label-float"><fieldset><legend><font size="2px">&nbsp;CST COFINS:</font></legend>
                  <select id="cofins_produto" name="procstcof" style="width:290px;" onchange="habilitaBotao()">
                      <option><?php switch ($procof) {
                                case '01':
                                    echo "01 - Operação Tributável com Alíquota Básica";
                                    break;
                                case '02':
                                    echo "02 - Operação Tributável com Alíquota Diferenciada";
                                    break;
                                case '03':
                                    echo "03 - Operação Tributável com Alíquota por Unidade de Medida";
                                    break;
                                case '04':
                                    echo "04 - Operação Tributável Monofásica - Revenda a Alíquota Zero";
                                    break;
                                case '05':
                                    echo "05 - Operação Tributável por Substituição Tributária";
                                    break;
                                case '06':
                                    echo "06 - Operação Tributável a Alíquota Zero";
                                    break;
                                case '07':
                                    echo "07 - Operação Isenta da Contribuição";
                                    break;
                                case '08':
                                    echo "08 - Operação sem Incidência da Contribuição";
                                    break;
                                case '09':
                                    echo "09 - Operação com Suspensão da Contribuição";
                                    break;
                                case '49':
                                    echo "49 - Outras Operações de Saída";
                                    break;
                                case '50':
                                    echo "50 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '51':
                                    echo "51 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '52':
                                    echo "52 - Operação com Direito a Crédito - Vinculada Exclusivamente";
                                    break;
                                case '53':
                                    echo "53 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '54':
                                    echo "54 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '55':
                                    echo "55 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '56':
                                    echo "56 - Operação com Direito a Crédito - Vinculada a Receitas";
                                    break;
                                case '60':
                                    echo "60 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '61':
                                    echo "61 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '62':
                                    echo "62 - Crédito Presumido - Operação de Aquisição Vinculada";
                                    break;
                                case '63':
                                    echo "63 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '64':
                                    echo "64 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '65':
                                    echo "65 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '66':
                                    echo "66 - Crédito Presumido - Operação de Aquisição Vinculada a";
                                    break;
                                case '67':
                                    echo "67 - Crédito Presumido - Outras Operações";
                                    break;
                                case '70':
                                    echo "70 - Operação de Aquisição sem Direito a Crédito";
                                    break;
                                case '71':
                                    echo "71 - Operação de Aquisição com Isenção";
                                    break;
                                case '72':
                                    echo "72 - Operação de Aquisição com Suspensão";
                                    break;
                                case '73':
                                    echo "73 - Operação de Aquisição a Alíquota Zero";
                                    break;
                                case '74':
                                    echo "74 - Operação de Aquisição sem Incidência da Contribuição";
                                    break;
                                case '75':
                                    echo "75 - Operação de Aquisição por Substituição Tributária";
                                    break;
                                case '98':
                                    echo "98 - Outras Operações de Entrada";
                                    break;
                                case '99':
                                    echo "99 - Outras Operações";
                                    break;
                            }?></option>
                      <option value="01"> 01 - Operação Tributável com Alíquota Básica</option>
                      <option value="02"> 02 - Operação Tributável com Alíquota Diferenciada</option>
                      <option value="03"> 03 - Operação Tributável com Alíquota por Unidade de Medida</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Produto</option> 
                      <option value="04"> 04 - Operação Tributável Monofásica - Revenda a Alíquota Zero</option>
                      <option value="05"> 05 - Operação Tributável por Substituição Tributária</option>
                      <option value="06"> 06 - Operação Tributável a Alíquota Zero</option>
                      <option value="07"> 07 - Operação Isenta da Contribuição</option>
                      <option value="08"> 08 - Operação sem Incidência da Contribuição</option>
                      <option value="09"> 09 - Operação com Suspensão da Contribuição</option>
                      <option value="49"> 49 - Outras Operações de Saída</option>
                      <option value="50"> 50 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita Tributada no Mercado Interno</option> 
                      <option value="51"> 51 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita Não-Tributada no Mercado Interno</option> 
                      <option value="52"> 52 - Operação com Direito a Crédito - Vinculada Exclusivamente</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a Receita de Exportação</option> 
                      <option value="53"> 53 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="54"> 54 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="55"> 55 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Não Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="56"> 56 - Operação com Direito a Crédito - Vinculada a Receitas</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tributadas e Não-Tributadas no Mercado Interno e</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Exportação</option> 
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita Tributada no Mercado Interno</option> 
                      <option value="61"> 61 - Crédito Presumido - Operação de Aquisição Vinculada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita Não-Tributada no Mercado Interno</option> 
                      <option value="62"> 62 - Crédito Presumido - Operação de Aquisição Vinculada</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exclusivamente a Receita de Exportação</option> 
                      <option value="63"> 63 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas e Não-Tributadas no Mercado Interno</option> 
                      <option value="64"> 64 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="65"> 65 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Não-Tributadas no Mercado Interno e de Exportação</option> 
                      <option value="66"> 66 - Crédito Presumido - Operação de Aquisição Vinculada a</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receitas Tributadas e Não-Tributadas no Mercado Interno e</option>
                      <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Exportação</option> 
                      <option value="67"> 67 - Crédito Presumido - Outras Operações</option>
                      <option value="70"> 70 - Operação de Aquisição sem Direito a Crédito</option>
                      <option value="71"> 71 - Operação de Aquisição com Isenção</option>
                      <option value="72"> 72 - Operação de Aquisição com Suspensão</option>
                      <option value="73"> 73 - Operação de Aquisição a Alíquota Zero</option>
                      <option value="74"> 74 - Operação de Aquisição sem Incidência da Contribuição</option>
                      <option value="75"> 75 - Operação de Aquisição por Substituição Tributária</option>
                      <option value="98"> 98 - Outras Operações de Entrada</option>
                      <option value="99"> 99 - Outras Operações</option>
                  </select>
                  </fieldset></div>
                  <div class="label-float"><p><input onkeypress="habilitaBotao()" type="text" id="alqcof_produto" name="proalqcof" value="<?php echo number_format($proalqcof, 2, ',', '.'); ?>" onclick="seleciona_texto(this)"><label>ALÍQUOTA COFINS:</label></div>
              <?php
              }
              ?>
              <div class="label-float"></div>
              <span class="btn btn-success fileinput-button">
              <span>SELECIONAR IMAGEM...</span>
              <input type="file" name="arquivo" accept="image/*">
              </span>
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
