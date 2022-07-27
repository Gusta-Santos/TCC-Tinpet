<?php
    include("../Cadastros/Conexao_BD.inc.php");

    session_start();
    $cod = $_GET["cod"];
    $codpet = $_GET["codpet"];

    $sql = "DELETE FROM relacao WHERE Rel_cod = '$cod'";
    if (mysqli_query($conexao, $sql)){

        //Mandando E-mail para primeiro responsável
        $sql = "SELECT * FROM animal, responsavel WHERE Pet_codigo =  '$codpet' AND animal.Resp_cpf = responsavel.Resp_cpf";
        $query = mysqli_query($conexao, $sql);
        foreach($query as $row){
            $nome = $row['Resp_nome'];
            $email = $row['Resp_email'];
            $nomepet1 = $row['Pet_nome'];
        }
        
        include("../Relacao/Mandar_email.inc.php");

        MandarEmail($email,
            "Atualizações sobre sua solicitação de relação",
            "Olá $nome! Infelizmente, a relação dos pets $nomepet1 e $nomepet2 foi cancelada pelo outro responsável.<br>
            Mas não desista, você pode buscar um outro pretendente para seu bichinho! <br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Atualizações sobre sua solicitação de relação",
            "Olá $nome! Infelizmente, a relação dos pets $nomepet1 e $nomepet2 foi cancelada pelo outro responsável.<br>
            Mas não desista, você pode buscar um outro pretendente para seu bichinho! <br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            "
        );

        $_SESSION["relacao"] = "cancelar";
        header('Location: ../Relacao/Menurelacao.php');
    } else {
        $_SESSION["errado"] = "errorcancelar";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        header('Location: ../Relacao/Menurelacao.php');
        die();
    }
?>