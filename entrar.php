<?php
session_start();
 include('login/conexao.php');               
	$query = "SELECT empfant FROM tbemp WHERE empcod = 1";
	$result = mysqli_query($conexao, $query) or die(mysqli_error());
	$reg = mysqli_num_rows($result);
	$linhas = mysqli_fetch_assoc($result);
	  $empfant = $linhas['empfant'];	  
	
?>

<html>
  <font face="Verdana">
  <head>	  
      <?php include('head.php');?> 
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>  
      <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
  </head>
  <body>      
      <header>
          <?php include('header.php');?>
      </header>
      <br><br><br>                                         
        <div class="login">
            <center><h2><?php echo  mb_strtoupper($empfant); ?></h2></center><br>            
          <form method="post" action="login/login.php">
            <!-- <div class="label-float"><input type="email" id="submit_email" name="login" value="" required><label>EMAIL:</label></div> -->
			<select id="select_login" name="login" required" style="width: 290px">              
                  <option></option>
                <?php
                include('login/conexao.php');
                $query_email = "SELECT opmail FROM tbop";
                $result_email = mysqli_query($conexao, $query_email) or die(mysqli_error());
                $reg_email = mysqli_num_rows($result_email);
                $linhas_email = mysqli_fetch_assoc($result_email);
                   if($reg_email > 0) {
                    // inicia o loop que vai mostrar todos os dados
                    do {                        
                  ?>                  
                  <option><?php echo $linhas_email['opmail']?></option>
                   <?php
                    // finaliza o loop que vai mostrar os dados
                        }while($linhas_email = mysqli_fetch_assoc($result_email));
                    // fim do if 
                    }              
                  ?> 
              </select>		  
			<FONT SIZE=2>EMAIL</FONT>
            <div class="label-float"><input type="password" id="submit_senha" name="password" value="" value="" required><FONT SIZE=2>SENHA</FONT></div>
            <p><center><input type="submit" id="submit_login" name="commit" value="ENTRAR"></center></p>
              <?php
                if(isset($_SESSION['nao_autenticado'])):
                ?>
                <div class="notification is-danger">
                  <center><font color="red">Usuário ou senha inválidos.</font></center>
                </div>
                <?php
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>
          </form>
        </div>        
  </body>
      <footer>
          <div>
              <center><p id="copyright">Copyright &copy; SacSystem</center>
          </div>
      </footer>
  </font>
</html>
