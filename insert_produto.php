<?php
	ini_set('display_errors', 0 );
	error_reporting(0);
	include_once("login/conexao.php");
	
	$procod = $_GET['procod'];
    if (empty($procod)) {
        $procod = 'NULL';
    }
    
    $dir = "img/prod"; 
    // recebendo o arquivo multipart 
    $file = $_FILES["arquivo"]; 
	
	$pronome = $_POST['pronome'];
    $proum = $_POST['proum'];
    $progrupo = $_POST['progrupo'];
    $proval = $_POST['proval'];    
    $proval = str_replace(',','.',$proval);
    $procusto = $_POST['procusto'];
    $procusto = str_replace(',','.',$procusto);
    $progtin = $_POST['progtin'];
    $proncm = $_POST['proncm'];
    $procest = $_POST['procest'];
    $procst = $_POST['procst'];
    $proalqicms = $_POST['proalqicms'];
    $proalqicms = str_replace(',','.',$proalqicms);
    $proipi = $_POST['proipi'];
    $proalqipi = $_POST['proalqipi'];
    $proalqipi = str_replace(',','.',$proalqipi);
    $procstpis = $_POST['procstpis'];
    $proalqpis = $_POST['proalqpis'];
    $proalqpis = str_replace(',','.',$proalqpis);
    $procstcof = $_POST['procstcof'];
    $proalqcof = $_POST['proalqcof'];
    $proalqcof = str_replace(',','.',$proalqcof);
    $propeso = $_POST['propeso'];
    $propeso = str_replace(',','.',$propeso);
    $procfopent = $_POST['procfopent'];
    $procfopsai = $_POST['procfopsai'];
    $proorig = $_POST['proorig'];
    $proenquad = $_POST['proenquad'];

    $pronome = strtoupper($pronome);
    $proum = strtoupper($proum);           
    $progrupo = strtoupper($progrupo); 
    
    $insert = "INSERT INTO tbpro (procod, pronome, proum, proval, procusto, progtin, proncm, procest, procst, proalqicms, proipi, proalqipi, procstpis, proalqpis, procstcof, proalqcof, progrupo, propeso, procfopent, procfopsai,proenquad, proorig) VALUES ($procod,'$pronome','$proum','$proval', '$procusto', '$progtin', '$proncm', '$procest', '$procst', '$proalqicms', '$proipi', '$proalqipi', '$procstpis', '$proalqpis', '$procstcof', '$proalqcof', '$progrupo', $propeso, '$procfopent', '$procfopsai', '$proenquad', '$proorig')
    ON DUPLICATE KEY UPDATE pronome = '$pronome', proum = '$proum', proval = '$proval', procusto = '$procusto', progtin = '$progtin', proncm = '$proncm', procest = '$procest', procst = '$procst', proalqicms = '$proalqicms', proipi = '$proipi', proalqipi = '$proalqipi', procstpis = '$procstpis', proalqpis = '$proalqpis', procstcof = '$procstcof', proalqcof = '$proalqcof', progrupo = '$progrupo', propeso = $propeso, procfopent = '$procfopent', procfopsai = '$procfopsai', proenquad = '$proenquad', proorig = '$proorig'";
	$result = mysqli_query($conexao, $insert);
	
	
	
    if(mysqli_affected_rows($conexao) > 0){
	 
        if ($procod == 'NULL') {
            $ultimo_produto = mysqli_insert_id($conexao);
            $pedido_apoio = "INSERT INTO tbped (pednfesit, pedtipo) VALUES ('APOIO', '0')";
            /*$result_pedido_apoio = mysqli_query($conexao, $pedido_apoio);
            $linha_pedido_apoio = mysqli_fetch_assoc($result_pedido_apoio); */ 
									
			if (mysqli_query($conexao, $pedido_apoio)) {
						
			} else {
			echo '<script>
					alert("FALHA NO CADASTRO DO PRODUTO.");
					window.location = "produtos.php";
				  </script>';
			}
            
            $ultimo_pedido = mysqli_insert_id($conexao);
            $zera_estoque = "INSERT INTO tbsai (saigtin, saiped, saiqtd) VALUES ($progtin, $ultimo_pedido, 0)";
        	/*$result_zera_estoque = mysqli_query($conexao, $zera_estoque);
            $linha_zera_estoque = mysqli_fetch_assoc($result_zera_estoque);*/
			
			if (mysqli_query($conexao, $zera_estoque)) {
						
			} else {
			echo '<script>
					alert("FALHA NO CADASTRO DO PRODUTO.");
					window.location = "produtos.php";
				  </script>';
			}

           if(isset($_FILES["arquivo"]) && !empty($_FILES["arquivo"]["name"])) {     
				if(file_exists("$dir/".$ultimo_produto.".jpg")) {
					chmod("$dir/".$ultimo_produto.".jpg",0755); //Change the file permissions if allowed
					unlink("$dir/".$ultimo_produto.".jpg"); //remove the file
				}
				
				
				// Move o arquivo da pasta temporaria de upload para a pasta de destino 
				if(move_uploaded_file($file["tmp_name"], "$dir/".$ultimo_produto.".jpg")) {
				}
				else
				{    echo  '<script>
							alert("FALHA NO ENVIO DA IMAGEM.");
						  </script>';
				}
			}
			
                 echo '<script>
                        //alert("PRODUTO CADASTRADO COM SUCESSO.");
                        window.location = "produtos.php";
                      </script>';
            
        } else {

            if(isset($_FILES["arquivo"]) && !empty($_FILES["arquivo"]["name"])) {   
				   if(file_exists("$dir/".$procod.".jpg")) {
                       chmod("$dir/".$procod.".jpg",0755); //Change the file permissions if allowed
                       unlink("$dir/".$procod.".jpg"); //remove the file
                  }
                // Move o arquivo da pasta temporaria de upload para a pasta de destino 
                  if(move_uploaded_file($file["tmp_name"], "$dir/".$procod.".jpg")) {
                  }
                  else
                  {    echo  '<script>
                              alert("FALHA NO ENVIO DA IMAGEM.");
                            </script>';
                  } 
            }
               
                echo '<script>
                        //alert("PRODUTO ATUALIZADO COM SUCESSO.");
                        window.location = "produtos.php";
                      </script>';
        }
                
			}else{				
				
				if(isset($_FILES["arquivo"]) && !empty($_FILES["arquivo"]["name"])) {   
				   if(file_exists("$dir/".$procod.".jpg")) {
                       chmod("$dir/".$procod.".jpg",0755); //Change the file permissions if allowed
                       unlink("$dir/".$procod.".jpg"); //remove the file
                  }
                // Move o arquivo da pasta temporaria de upload para a pasta de destino 
                  if(move_uploaded_file($file["tmp_name"], "$dir/".$procod.".jpg")) {
                  }
                  else
                  {    echo  '<script>
                              alert("FALHA NO ENVIO DA IMAGEM.");
                            </script>';
                  } 
				  echo '<script>
                        //alert("PRODUTO ATUALIZADO COM SUCESSO.");
                        window.location = "produtos.php";
                      </script>';
                } else {               
                
				echo '<script>
                        alert("NENHUMA ALTERACAÇÃO REALIZADA.");
                        window.location = "produtos.php";
                      </script>'; 
				}
			}
?>
