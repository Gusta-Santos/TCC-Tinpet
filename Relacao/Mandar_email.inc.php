<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandar e-mail</title>
</head>
<body>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    function MandarEmail($destinatario, $assunto, $mensagem, $msgAlternativa){
        if (!class_exists('PHPMailer\PHPMailer\Exception')){
                require 'src/Exception.php';
                require 'src/PHPMailer.php';
                require 'src/SMTP.php';
        }
        $mail = new PHPMailer;
        //Configurações do servidor
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = "587";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Username = "tinpet.naoresponda@gmail.com";
        $mail->Password = "tinpetcontato13";
        //Configurações da mensagem
        $mail->setFrom('tinpet.naoresponda@gmail.com', 'Tinpet');
        $mail->addAddress($destinatario);
        $mail->Subject = utf8_decode($assunto);
        $mail->isHTML(true);
        $mail->Body = utf8_decode($mensagem);
        $mail->AltBody = utf8_decode($msgAlternativa);

       if($mail->send()){
            
        }else{
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] = "Falha ao enviar" . $mail->ErrorInfo;
            header('Location: Infopet.php');
            die();
        }
    }
    ?>
</body>
</html>