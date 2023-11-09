<?php

include "../../PHPMailer-master/PHPMailerAutoload.php"; 
$empresa = $_GET['empnome'];
$pedido = $_GET['pedcod'];

include('login/conexao.php');
$query_tbped = "SELECT pedchave, pednfe FROM tbped WHERE pedcod = $pedido";
$result_tbped = mysqli_query($conexao, $query_tbped) or die(mysqli_error());
$reg_tbped = mysqli_num_rows($result_tbped);
$linhas_tbped = mysqli_fetch_assoc($result_tbped);

$chave = $linhas_tbped['pedchave'];
$nfe = $linhas_tbped['pednfe'];

$to = $_POST['email_dest'];
$to = strtolower($to);

$subject = "Nota Fiscal: ".$nfe." - Pedido: ".$pedido;
$txt = '<html><body>Clique no link para visualizar a Danfe: <a href="http://nfe.sacsystem.com.br/danfe/'.$chave.'">Danfe</a></br>
        Clique no link para visualizar o XML: <a href="http://nfe.sacsystem.com.br/xmlnfe/'.$chave.'">XML</a>
        </body></html>';

// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 

// Método de envio 
$mail->IsSMTP(); 

// Enviar por SMTP 
$mail->Host = "smtp.umbler.com"; 

// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = 587; 


// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 

// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
$mail->Username = 'sistema@sacsystem.com.br'; 
$mail->Password = 'Dpkg,9k01'; 

// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 

// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
#$mail->SMTPDebug = 2; 

// Define o remetente 
// Seu e-mail 
$mail->From = "sistema@sacsystem.com.br"; 

// Seu nome 
$mail->FromName = $empresa; 

// Define o(s) destinatário(s) 
$mail->AddAddress($to, ''); 

// Opcional: mais de um destinatário
// $mail->AddAddress('fernando@email.com'); 

// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 

// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 

// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 

// Assunto da mensagem 
$mail->Subject = $subject; 

// Corpo do email 
$mail->Body = $txt; 

// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

// Envia o e-mail 
$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
if ($enviado) 
{ 
	echo '<script>
              alert("E-MAIL ENVIADO COM SUCESSO.");
              window.location = "pedidos.php";
              </script>';
     
} else {
	 echo '<script>
              alert("FALHA NO ENVIO DO E-MAIL.");
              window.location = "pedidos.php";
              </script>';
 
   # echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
}
?>
