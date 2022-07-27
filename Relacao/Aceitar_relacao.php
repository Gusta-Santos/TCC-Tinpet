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

    $sql = "UPDATE relacao SET Rel_status = 'A' WHERE Rel_cod = '$cod'";
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
            "Olá $nome! Trazemos ótimas notícias, a solicitação de relação de $nomepet1 para com $nomepet2 foi correspondida!<br>
            O próximo passo é acessar o tinpet, fazer o seu login, ir na página menu de relações e clicar na opção 'informações do outro responsável' para achar as informações e entrar em contato com o outro responsável.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            ",
            "Olá $nome! Trazemos ótimas notícias, a solicitação de relação de $nomepet1 para com $nomepet2 foi correspondida!<br>
            O próximo passo é acessar o tinpet, fazer o seu login, ir na página menu de relações e clicar na opção 'informações do outro responsável' para achar as informações e entrar em contato com o outro responsável.<br>
            <img src='https://i.ibb.co/kypD2tH/Logo.png'>
            "
        );

        $_SESSION["relacao"] = "aceitar";
        header('Location: Menurelacao.php');
    } else {
        $_SESSION["errado"] = "erroraceitar";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        header('Location: Menurelacao.php');
        die();
    }
?>