<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $sql1 = "SELECT Resp_login, Resp_senha FROM responsavel";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false; 
    while($row = mysqli_fetch_assoc($query)) {
        if($login == $row["Resp_login"] && $senha == $row["Resp_senha"]){
            $auxiliar = true;
        }
    }

    if($auxiliar ==  true){
        $sql = "UPDATE responsavel SET Resp_status = 'Ativo' WHERE Resp_login = '$login'";
        if (mysqli_query($conexao, $sql)){
            // $_SESSION["certo"] = "certo";
            $_SESSION["Resp_cpf"] = $cpf;
            header('Location: ../Principal/Login_resp.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            header('Location: Reativar_responsavel.php');
            die();
        }
    } else {
        $_SESSION["verificadora"] = "verificadora";
        header('Location: Reativar_responsavel.php');
        die();
    }
?>