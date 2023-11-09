<html>
  <font face="Verdana">
  <head>
	  <?php include('head.php');?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>  
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	        
      <?php $pedcod = $_GET['pedcod']; 
	  $emissornome = $_POST['emissornome'];
	  if (empty($emissornome)) {
		  $emissornome = 'PRINCIPAL';
	  }
      if (empty($pedcod)) {
          echo '<script>
                 alert("NECESSÁRIO INFORMAR NÚMERO DO PEDIDO.");
                 window.location = "pedidos.php";
               </script>';
      }else{
				
	  }
      ?>
  </head>
  <body>
  <div class="load"> <i class="fa fa-cog fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> </div>
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
      
      
      $query_tbped = "SELECT pedcli, pedncli, pednfor, pedtot, pedtipo, pedfrete, peddesc, pedvol, pedqvol, 
      pednfesit FROM tbped WHERE pedcod = $pedcod";
      $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
      $reg_tbped = mysqli_num_rows($result_tbped);
      $linhas_tbped = mysqli_fetch_assoc($result_tbped);
      
      if ($linhas_tbped['pednfesit'] == 'FATURADO'){
          ?>
            <script type="text/javascript">
                alert('PEDIDO JÁ FOI FATURADO');
                window.location = "faturamento.php";
            </script>  
            <?php
            exit();
      }
      
	  $pedcli = $linhas_tbped['pedcli'];
      $pedtot = $linhas_tbped['pedtot'];
      $pedfrete = $linhas_tbped['pedfrete'];
      $peddesc = $linhas_tbped['peddesc'];
      $pedvol = $linhas_tbped['pedvol'];
      $pedqvol = $linhas_tbped['pedqvol'];
      $natureza = $linhas_tbped['pedtipo'];
      if ($natureza == '0') {
          $natureza = 'ENTRADA DE MERCADORIA';
          $cli_for = 'FORNECEDOR';
          $cli_for_nome = $linhas_tbped['pednfor'];
      }else{
          $natureza = 'VENDA DE MERCADORIA';
          $cli_for = 'CLIENTE';
          $cli_for_nome = $linhas_tbped['pedncli'];
      }
	  
      ?>
      <div class="cadastros">
          <center><h2>Faturamento do Pedido</h2></center><br> 
		  <form name="form_fat_pedido" id="form_fat_pedido" method="POST" action="nfe/<?php echo $emissornome;?>/emissaoNotaFiscal.php?pedcod=<?php echo $pedcod ?>&emissordir=<?php echo $emissornome; ?>" autocomplete="off" onsubmit="EmitindoNFE()">			
              <div class="label-float"><input type="text" id="numero_pedido" name="pedcod" value="<?php echo $pedcod; ?>" disabled><label>PEDIDO:</label></div>
              <div class="label-float"><input type="text" id="numero_pedido" name="pedcod" value="<?php echo $cli_for_nome; ?>" disabled><label><?php echo $cli_for; ?>:</label></div>
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM' and $linhas_tbped['pedtipo'] == 1) {
              ?>
              <div class="label-float"><input type="text" id="natureza_operacao" name="natureza_operacao" value="<?php echo $natureza; ?>"><label>NATUREZA DA OPERAÇÃO:</label></div>
              <?php
              }
              ?>
        <div class="label-float"><fieldset><legend><font size="2px">&nbsp;TIPO DE PAGAMENTO:</font></legend>
              <select id="pagamento" name="pagamento" style="width:290px;" onchange="habilitaBotao();" required>
                  <option></option>
                  <option value="0">0 - Pagamento à vista</option>
                  <option value="1">1 - Pagamento a prazo</option>
              </select>
              </fieldset></div>
        <div class="label-float"><fieldset><legend><font size="2px">&nbsp;MEIO DE PAGAMENTO:</font></legend>
              <select id="forma_pagamento" name="forma_pagamento" style="width:290px;" onchange="habilitaBotao()" required>
                  <option></option>
                  <option value="01">01 - Dinheiro</option>
                  <option value="02">02 - Cheque</option>
                  <option value="03">03 - Cartão de Crédito</option>
                  <option value="04">04 - Cartão de Débito</option>
                  <option value="05">05 - Crédito Loja</option>
                  <option value="10">10 - Vale Alimentação</option>
                  <option value="11">11 - Vale Refeição</option>
                  <option value="12">12 - Vale Presente</option>
                  <option value="13">13 - Vale Combustível</option>
                  <option value="14">14 - Duplicata Mercantil</option>
                  <option value="15">15 - Boleto Bancário</option>
                  <option value="90">90 - Sem pagamento</option>
                  <option value="99">99 - Outros</option>
              </select>
              </fieldset></div>
		<div class="label-float"><fieldset><legend><font size="2px">&nbsp;QUANTIDADE DE PARCELAS:</font></legend>
              <select id="qtd_parcelas" name="qtd_parcelas" style="width:290px;" onchange="habilitaBotao()">
                  <option></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
              </select>
              </fieldset></div>
		<div class="label-float"><fieldset><legend><font size="2px">&nbsp;PRIMEIRO VENCIMENTO:</font></legend>
              <input id="vencimento" name="vencimento" type="date">
              </fieldset></div>
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM' and $linhas_tbped['pedtipo'] == 1) {
              ?>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;FORMA DE VENDA:</font></legend>
              <select id="forma_venda" name="forma_venda" style="width:290px;" onchange="habilitaBotao()" required>
                  <option></option>
                  <option value="0">0 - Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste)</option>
                  <option value="1">1 - Operação presencial</option>
                  <option value="2">2 - Operação não presencial, pela Internet</option>
                  <option value="3">3 - Operação não presencial, Teleatendimento</option>
                  <option value="4">4 - NFC-e em operação com entrega a domicílio</option>
                  <option value="5">5 - Operação presencial, fora do estabelecimento</option>
                  <option value="9">9 - Operação não presencial, outros</option>
              </select>
              </fieldset></div>
              <?php
              }
              ?>
          <!--<div class="label-float"><fieldset><legend><font size="2px">&nbsp;TRANSPORTADORA:</font></legend>
              <select id="trasnportadora" name="trasnportadora" style="width:290px;" onchange="habilitaBotao()" required>
                  <option></option>
                  <option value="0">PRÓPRIA</option>
              </select>
              </fieldset></div>-->
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM' and $linhas_tbped['pedtipo'] == 1) {
              ?>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;TIPO DE FRETE:</font></legend>
              <select id="tipo_frete" name="tipo_frete" style="width:290px;" onchange="habilitaBotao()" required>
                  <option></option>
                  <option value="0">0 - Contratação do Frete por conta do Remetente (CIF)</option>
                  <option value="1">1 - Contratação do Frete por conta do Destinatário (FOB)</option>
                  <option value="2">2 - Contratação do Frete por conta de Terceiros</option>
                  <option value="3">3 - Transporte Próprio por conta do Remetente</option>
                  <option value="4">4 - Transporte Próprio por conta do Destinatário</option>
                  <option value="9">9 - Sem Ocorrência de Transporte</option>
              </select>
              </fieldset></div>
              <?php
              }
              if ($linhas_tbemp['empnfe'] == 'SIM' and $linhas_tbped['pedtipo'] == 1) {
              ?>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;VEÍCULO:</font></legend>
              <select id="select_veiculo" name="select_cad_veiculo" onkeypress="habilitaBotao()">
                <option></option>
                <?php
                include('login/conexao.php');
                $query1 = "SELECT carcod, carmod, carplaca FROM tbcar";
                $result1 = mysqli_query($conexao, $query1) or die(mysqli_error());
                $reg1 = mysqli_num_rows($result1);
                $linhas1 = mysqli_fetch_assoc($result1);
                   if($reg1 > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                        
                  ?>                  
                  <option value='<?php echo $linhas1['carcod']?>'><?php echo "(".$linhas1['carplaca'].") ".$linhas1['carmod']?></option>
                   <?php
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas1 = mysqli_fetch_assoc($result1));
                    // fim do if 
                    }              
                  ?> 
              </select>
              </fieldset></div>
              <?php
              }
              ?>
              <div class="label-float"><fieldset><legend><font size="2px">&nbsp;TIPO DE VOLUME:</font></legend>
              <select id="tipo_volume" name="tipo_volume" style="width:290px;" onchange="habilitaBotao()" required>
                  <option><?php echo $pedvol; ?></option>
                  <option value="CAIXA">CAIXA</option>
                  <option value="PACOTE">PACOTE</option>
                  <option value="SACO">SACO</option>
                  <option value="PALETE">PALETE</option>
                  <option value="FARDO">FARDO</option>
                  <option value="ROLO">ROLO</option>
                  <option value="ENVELOPE">ENVELOPE</option>
              </select>
              </fieldset></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="number" id="volumes" name="volumes" value="<?php echo $pedqvol; ?>" onclick="seleciona_texto(this)"  required><label>VOLUMES:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="frete" name="frete" value="<?php echo 'R$ '.number_format($pedfrete, 2, ',', '.'); ?>" onkeyup="calculaNota()" onclick="seleciona_frete(this)" required><label>FRETE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="desconto" name="desconto" value="<?php echo 'R$ '.number_format($peddesc, 2, ',', '.'); ?>" onkeyup="calculaNota()"  onclick="seleciona_desconto(this)" required><label>DESCONTO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="total_bruto" name="total_bruto" value="<?php echo 'R$ '.number_format(($pedtot-$pedfrete)+$peddesc, 2, ',', '.'); ?>" disabled><label>TOTAL DOS PRODUTOS:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="total" name="total" value="<?php echo 'R$ '.number_format($pedtot, 2, ',', '.'); ?>" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" readonly><label>TOTAL DO PEDIDO:</label></div>
              <?php
              if ($linhas_tbemp['empnfe'] == 'SIM' and $linhas_tbped['pedtipo'] == 1) {
              ?>
              <div class="label-float"></div>              
              <?php
              }
              ?>
			  <div style="text-align:center">
			  
			  <font size="2px"><input type="checkbox" id="checkbox_faturar" name="checkbox_faturar" value="FATURAR" checked><label>EMITIR NFE</label></font>
			  </div>			  
              <div class="label-float"></div>			  
              <input type="button" id="submit_cadastros" value="FATURAR" onclick="VerificaCampos()">
        </form>
      </div>          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>