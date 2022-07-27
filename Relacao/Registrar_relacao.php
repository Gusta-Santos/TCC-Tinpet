<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar_relacao</title>
</head>
<body>
    <?php
    include("../Cadastros/Conexao_BD.inc.php");

    session_start();
    $cod1 = trim($_SESSION["Pet_codigo"]);
    $cod2 = trim($_SESSION["Pet_codigo2"]);
    $data = date('Y-m-d');

    //Fazendo verificação para saber se existem relações repetidas
    $sql1 = "SELECT Rel_codpet1,Rel_codpet2 FROM relacao";
    $query1 = mysqli_query($conexao, $sql1);
    $auxiliar = "false";

    while($row = mysqli_fetch_assoc($query1)) {
        if(($row["Rel_codpet1"] == $cod1 && $row["Rel_codpet2"] == $cod2) || ($row["Rel_codpet1"] == $cod2 && $row["Rel_codpet2"] == $cod1)){
            $auxiliar = "true";
        }
    }

    if($auxiliar == "false"){

    $sql = "INSERT INTO relacao (Rel_cod,Rel_codpet1, Rel_codpet2, Rel_data, Rel_status)
    VALUES (null,'$cod1','$cod2','$data','D')";

    if (mysqli_query($conexao, $sql)){
        //Mandando E-mail
        $sql = "SELECT * FROM animal, responsavel WHERE Pet_codigo =  '$cod2' AND animal.Resp_cpf = responsavel.Resp_cpf";
        $query = mysqli_query($conexao, $sql);
        foreach($query as $row){
            $nome = $row['Resp_nome'];
            $email = $row['Resp_email'];
            $nomepet = $row['Pet_nome'];
        }
        
        include("../Relacao/Mandar_email.inc.php");

        MandarEmail($email,
            "Um novo pet tem interesse no seu!",
            "Olá $nome! Um animal novo tem interesse no seu pet $nomepet. Para ter mais informações sobre acesse o site do tinpet e
            faça sua escolha.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Olá $nome! Um animal novo tem interesse no seu pet $nomepet. Para ter mais informações sobre acesse o site do tinpet e
            faça sua escolha.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>"
        );
        
        $_SESSION["certo"] = "certo";
        header('Location: Menurelacao.php');
    } else {
        $_SESSION["errado"] = "errado";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        header('Location: Infopet.php');
    }
    } else if($auxiliar == "true"){
        $_SESSION["errado"] = "iguais";
        header('Location: Infopet.php');
    }
    ?>
</body>
</html>