<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $codigo = $_POST["codigo"];
    $senha = $_POST["senha"];
    $login = $_SESSION["Resp_login"];

    $sql1 = "SELECT Resp_senha FROM responsavel WHERE Resp_login = '$login'";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false; 
    while($row = mysqli_fetch_assoc($query)) {
        if($senha == $row["Resp_senha"]){
            $auxiliar = true;
        }
    }
    if($auxiliar ==  true){
        $sql = "UPDATE animal SET Pet_status = 'Ativo', Pet_dispo = 1 WHERE Pet_codigo = '$codigo'";
        if (mysqli_query($conexao, $sql)){
            header('Location: ../Principal/Menuresp.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["codigo"] = $codigo;
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            header('Location: Reativar_animal.php');
            die();
        }
    } else {
        $_SESSION["verificadora"] = "verificadora";
        $_SESSION["codigo"] = $codigo;
        header('Location: Reativar_animal.php');
        die();
    }
?>