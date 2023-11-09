<?php 
$variaveis = 'pedcod='.$_GET['pedcod'].$_SERVER['QUERY_STRING'];
?>
<html>
  <font face="Verdana">
  <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>       
      <?php include('head.php');?>
      <?php $pedcod = $_GET['pedcod'];
	  
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
      
      
      $query_tbped = "SELECT pedncli, pednfor, pedtot, pedtipo, pedfrete, peddesc, pedvol, pedqvol 
      FROM tbped WHERE pedcod = $pedcod";
      $result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
      $reg_tbped = mysqli_num_rows($result_tbped);
      $linhas_tbped = mysqli_fetch_assoc($result_tbped);
      
      $pedtot = $linhas_tbped['pedtot'];
      $pedfrete = $linhas_tbped['pedfrete'];
      $peddesc = $linhas_tbped['peddesc'];
      $pedvol = $linhas_tbped['pedvol'];
      $pedqvol = $linhas_tbped['pedqvol'];
      $natureza = $linhas_tbped['pedtipo'];
      if ($natureza == '0') {
          $update = "UPDATE tbped SET peddata = now(), pedhora = now(), pednfesit = 'RECEBIDO' WHERE pedcod = $pedcod";
          $result = mysqli_query($conexao, $update);
          echo '<script>
                 window.location = "pedidos.php?tipo_pedido=compras";
               </script>';
          //$natureza = 'ENTRADA DE MERCADORIA';
          //$cli_for = 'FORNECEDOR';
          //$cli_for_nome = $linhas_tbped['pednfor'];
      }else{
          $natureza = 'VENDA DE MERCADORIA';
          $cli_for = 'CLIENTE';
          $cli_for_nome = $linhas_tbped['pedncli'];
      }
      ?>
      <div class="cadastros">
          <center><h2>Finalização do Pedido</h2></center><br> 
          <form name="form_fat_pedido" method="POST" action="envia_faturamento.php?<?php echo $variaveis ?>" autocomplete="off">           
              <div class="label-float"><input type="text" id="numero_pedido" name="pedcod" value="<?php echo $pedcod; ?>" disabled><label>PEDIDO:</label></div>
              <div class="label-float"><input type="text" id="cliente_pedido" name="pedcod" value="<?php echo $cli_for_nome; ?>" disabled><label><?php echo $cli_for; ?>:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="frete" name="frete" value="<?php echo 'R$ '.number_format(0, 2, ',', '.'); ?>" onkeyup="calculaNota()" onclick="seleciona_frete(this)" required><label>FRETE:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="desconto" name="desconto" value="<?php echo 'R$ '.number_format($peddesc, 2, ',', '.'); ?>" onkeyup="calculaNota()"  onclick="seleciona_desconto(this)" required><label>DESCONTO:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="total_bruto" name="total_bruto" value="<?php echo 'R$ '.number_format(($pedtot-$pedfrete)+$peddesc, 2, ',', '.'); ?>" disabled><label>TOTAL DOS PRODUTOS:</label></div>
              <div class="label-float"><input onkeypress="habilitaBotao()" type="text" id="total" name="total" value="<?php echo 'R$ '.number_format($pedtot, 2, ',', '.'); ?>" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" readonly><label>TOTAL DO PEDIDO:</label></div>
              <div class="label-float"></div>
              <input type="submit" id="submit_cadastros" value="FINALIZAR">
        </form>
      </div>          
  </body>      
  <footer>
      <?php include('footer.php');?>
  </footer>
  </font>
</html>