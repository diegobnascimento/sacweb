<?php
error_reporting(E_ERROR | E_PARSE);
?>
<title>SacWEB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta Http-Equiv="Cache-Control" Content="no-cache">  
<meta Http-Equiv="Pragma" Content="no-cache">  
<meta Http-Equiv="Expires" Content="0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="shortcut icon" href="img/favicon.ico" />
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
if (window.performance && window.performance.navigation.type == 2) {
    document.location.reload(true);
}
</script>
<?php
$variaveis = $_SERVER['QUERY_STRING'];
$variaveis = str_replace('&resolucao=pequena', '', $variaveis);
$atual =  basename( __FILE__ );
?>

<script>         
function doOnOrientationChange()
  {
	var orientacao
	var url
	var arquivo
	var diretorio
	switch(window.orientation) 
	{  
	  case -90:
	  case 90:		
		orientacao = 'landscape';
		url = window.location;
		arquivo = "<?php echo $arquivo;?>";
		variaveis = "<?php echo $variaveis;?>";	
        window.location = arquivo+"?"+variaveis;		
		alert('SISTEMA INCOMPATÍVEL COM ROTAÇÃO DE TELA.');
		//alert(arquivo);
		//alert(variaveis);
		break; 
	  default:	
        //orientacao = 'portrait';
		//alert(orientacao);		
		break; 
	}
  }
 
  window.addEventListener('orientationchange', doOnOrientationChange);
  
 
  // Initial execution if needed
  doOnOrientationChange();
</script> 
<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.sacsystem.sacweb") {
	$dispositivo = 'mobile';
} else {
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
	$windowsphone = strpos($_SERVER['HTTP_USER_AGENT'],"Windows Phone");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian || $windowsphone == true) {
		$dispositivo = "mobile";
	} else { 
		$dispositivo = "computador";			
	}
} 

if ($dispositivo == 'computador') {
	echo "
		<script>        
		// Defining event listener function
		function displayWindowSize(){
			// Get width and height of the window excluding scrollbars
			var w = document.documentElement.clientWidth;
			var h = document.documentElement.clientHeight;
			
			// Display result inside a div element
			//document.getElementById('result').innerHTML = 'Width: ' + w + ', ' + 'Height: ' + h;
			if (w < 1135) {					
				alert('RESOLUÇÃO DE JANELA ABAIXO DO IDEAL PARA USO DO SISTEMA.')
			}
		}
			
		// Attaching the event listener function to window's resize event
		window.addEventListener('resize', displayWindowSize);

		// Calling the function for the first time
		displayWindowSize();
		</script>";
}
