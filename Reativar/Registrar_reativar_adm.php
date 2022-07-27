<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $sql1 = "SELECT Adm_login, Adm_senha FROM administrador";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false; 
    while($row = mysqli_fetch_assoc($query)) {
        if($login == $row["Adm_login"] && $senha == $row["Adm_senha"]){
            $auxiliar = true;
        }
    }

    if($auxiliar ==  true){
        $sql = "UPDATE administrador SET Adm_status = 'Ativo' WHERE Adm_login = '$login'";
        if (mysqli_query($conexao, $sql)){
            // $_SESSION["certo"] = "certo";
            $_SESSION["Adm_cpf"] = $cpf;
            header('Location: ../Principal/Login_adm.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            header('Location: Reativar_administrador.php');
            die();
        }
    } else {
        $_SESSION["verificadora"] = "verificadora";
        header('Location: Reativar_administrador.php');
        die();
    }
?>