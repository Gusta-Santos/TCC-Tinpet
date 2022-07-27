<?php

    include("../Cadastros/Conexao_BD.inc.php");

    session_start();
    $cod = $_GET["cod"];
    $cod1 = $_GET["cod1"];
    $cod2 = $_GET["cod2"];

    $sql1 = "SELECT Resp_nome,Resp_email FROM animal, responsavel WHERE Pet_codigo =  '$cod2' AND animal.Resp_cpf = responsavel.Resp_cpf";
    $query1 = mysqli_query($conexao, $sql1);
    while($row1 = mysqli_fetch_assoc($query1)){
                $nome1 = $row1["Resp_nome"];
                $email1 = $row1["Resp_email"];
    }

    $sql = "DELETE FROM relacao WHERE Rel_cod = '$cod'";
    if (mysqli_query($conexao, $sql)){
        //Mandando E-mail para primeiro responsável
        $sql = "SELECT * FROM animal, responsavel WHERE Pet_codigo =  '$cod1' AND animal.Resp_cpf = responsavel.Resp_cpf";
        $query = mysqli_query($conexao, $sql);
        foreach($query as $row){
            $nome = $row['Resp_nome'];
            $email = $row['Resp_email'];
            $nomepet1 = $row['Pet_nome'];
        }

        include("../Relacao/Mandar_email.inc.php");

        //Mandar email para o primeiro responsavel
        MandarEmail($email,
            "Atualizações sobre sua solicitação de relação",
            "Olá $nome! Felizmente deu tudo certo na relação do seu bichinho como você mesmo nos informou, obrigado por utilizar o Tinpet.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Olá $nome! Felizmente deu tudo certo na relação do seu bichinho como você mesmo nos informou, obrigado por utilizar o Tinpet.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>"
        );

        //Mandar email para o segundo responsavel
        MandarEmail($email1,
            "Atualizações sobre sua solicitação de relação",
            "Olá $nome1! Felizmente deu tudo certo na relação do seu bichinho como você mesmo nos informou, obrigado por utilizar o Tinpet.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Olá $nome1! Felizmente deu tudo certo na relação do seu bichinho como você mesmo nos informou, obrigado por utilizar o Tinpet.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>"
        );

        $_SESSION["relacao"] = "deucerto";
        header('Location: Menurelacao.php');
        die();
    }
?>