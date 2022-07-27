<?php
    include("../Cadastros/Conexao_BD.inc.php");

    session_start();
    $cod = $_GET["cod"];
    $cod1 = $_GET["cod1"];
    $cod2 = $_GET["cod2"];


    $sql1 = "SELECT Pet_nome FROM animal, relacao WHERE Pet_codigo =  '$cod2' AND animal.Pet_codigo = relacao.Rel_codpet2";
    $query1 = mysqli_query($conexao, $sql1);
    while($row1 = mysqli_fetch_assoc($query1)){
                $nomepet2 = $row1["Pet_nome"];
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

        MandarEmail($email,
            "Atualizações sobre sua solicitação de relação",
            "Olá $nome! Infelizmente, a demonstração de interesse feita por $nomepet1 para com $nomepet2, não foi correspondida. Por isso, cancelamos
            a relação.<br>
            Mas não desista, você pode buscar um outro pretendente para seu bichinho! <br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Olá $nome! Infelizmente, a demonstração de interesse feita por $nomepet1 para com $nomepet2, não foi correspondida. Por isso, cancelamos
            a relação.<br>
            Mas não desista, você pode buscar um outro pretendente para seu bichinho! <br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>"
        );

        $_SESSION["relacao"] = "rejeitar";
        header('Location: Menurelacao.php');
        
        die();
    } else {
        $_SESSION["errado"] = "errorejeitar";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        header('Location: Menurelacao.php');
        die();
    }
?>