<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$dir = "xml/"; 
// recebendo o arquivo multipart 
$file = $_FILES["arquivo"]; 
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
if (move_uploaded_file($file["tmp_name"], "$dir/".$file["name"])) { 
    header('Location: import_xml.php?xml='.$file["name"]); 
} 
else { 
    echo "Erro, o arquivo n&atilde;o pode ser enviado."; 
}    
?>
