<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
    include_once("login/conexao.php");
    $dir = "img/prod";
    $procod = $_GET['procod'];
    if ((empty($procod)) or ($procod == 'undefined')) {
			header('Location: ./produtos.php');
			exit();
		}
    
    $estpro = $procod;
    $query_sai = "select sum(tbsai.saiqtd) as saiqtd from tbsai inner join tbped on (tbsai.saiped = tbped.pedcod) where tbped.pedtipo = 1 and tbsai.saipro = $estpro";
    $result_sai = mysqli_query($conexao, $query_sai) or die(mysqli_error());
    $reg_sai = mysqli_num_rows($result_sai);
    $linhas_sai = mysqli_fetch_assoc($result_sai);
    $estsai = $linhas_sai['saiqtd'];
    if (empty($estsai)) {
        $estsai = 0;
    }
    $query_ent = "select sum(tbsai.saiqtd) as saiqtd from tbsai inner join tbped on (tbsai.saiped = tbped.pedcod) where tbped.pedtipo = 0 and tbsai.saipro = $estpro";
    $result_ent = mysqli_query($conexao, $query_ent) or die(mysqli_error());
    $reg_ent = mysqli_num_rows($result_ent);
    $linhas_ent = mysqli_fetch_assoc($result_ent);
    $estent = $linhas_ent['saiqtd'];
    if (empty($estent)) {
        $estent = 0;
    }
    $estqtd = $estent - $estsai;
    
    if ($estqtd > 0) {
        echo '<script>
                alert("PRODUTO POSSUI ESTOQUE, NÃO É POSSÍVEL EXCLUIR.");
                window.location = "produtos.php";
              </script>';
              exit;
    }
    
    if ($estqtd < 0) {
        echo '<script>
                alert("PRODUTO POSSUI ESTOQUE NEGATIVO, NÃO É POSSÍVEL EXCLUIR.");
                window.location = "produtos.php";
              </script>';
              exit;
    }
		
	$delete = "DELETE FROM tbpro WHERE procod = $procod";
	$result = mysqli_query($conexao, $delete);
	
	if(mysqli_affected_rows($conexao) > 0){
				echo '<script>
                        //alert("PRODUTO EXCLUﾃ好O COM SUCESSO.");
                        window.location = "produtos.php";
                      </script>';
               if(file_exists("$dir/".$procod.".jpg")) {
                 chmod("$dir/".$procod.".jpg",0755); //Change the file permissions if allowed
              	 unlink("$dir/".$procod.".jpg"); //remove the file
               }
			}else{
				echo '<script>
                        alert("FALHA NO EXCLUSﾃグ DO PRODUTO.");
                        window.location = "produtos.php";
                      </script>';
			}
?>
