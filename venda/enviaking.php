<?php
session_start();
date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$email_destinatario = $_SESSION['usuariologado']['email'];
$nome_destinario = $_SESSION['usuariologado']['nome'];

$mail->isSMTP();
    
$mail->Debugoutput = 'html';

$mail->Host = 'smtp.kinghost.net';

$mail->Port = 587;

$mail->SMTPSecure = '';

$mail->SMTPAuth = true;

$mail->Username = 'ecotube@projetoscti.com.br'; //Preencher com o usuário da sua conta Gmail

$mail->Password = 'H@rryl1ndo';

$mail->From='ecotube@projetoscti.com.br'; //Preencher com a sua conta Gmail

$mail->FromName='EcoTube'; //Preencher com o nome do remetente

$mail->addAddress($email_destinatario); //Preencher com o email e nome de quem receberá a mensagem

$mail->Subject = 'Compra finalizada com sucesso!'; //Preencher com o assunto do email

$mail->isHTML(true); //Configurar mensagem como HTML

$mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML

$mail->Body = '<html><head><meta charset="utf-8"></head><body>Olá, '.$nome_destinario.'. Obrigado pela compra!<br>A equipe da EcoTube agradece pela preferência!</body></html>'; //Mensagem em HTML

if (!$mail->send()) {
    echo '<script language="javascript">';
    echo "alert('Erro no email. ".$mail->ErrorInfo."')";
    echo '</script>';
}

?>