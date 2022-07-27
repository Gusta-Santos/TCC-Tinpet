<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $cpf = $_SESSION["Resp_cpf"];
    $senha = $_POST["senha"];

    $sql1 = "SELECT Resp_senha FROM responsavel WHERE Resp_cpf = '$cpf'";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false;
    while($row = mysqli_fetch_assoc($query)) {
        if($senha == $row["Resp_senha"]){
            $auxiliar = true;
        } 
    }
    if($auxiliar == true){    
    $sql = "UPDATE responsavel SET Resp_status = 'Inativo' WHERE Resp_cpf = '$cpf'";
    $sql1 = "UPDATE animal SET Pet_status = 'Inativo', Pet_dispo = 0  WHERE Resp_cpf = '$cpf'";
    if (mysqli_query($conexao, $sql) && mysqli_query($conexao, $sql1)){
        /*$_SESSION["certo"] = "certo";
        $_SESSION["Resp_cpf"] = $cpf;*/
        header('Location: ../Principal/Logout.php');
        die();
    } else {
        $_SESSION["errado"] = "errado";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        $_SESSION["Resp_cpf"] = $cpf;
        header('Location: Excluir_responsavel.php');
        die();
    }
    } else {
        $_SESSION["erradosenha"] = "erradosenha";
        header('Location: Excluir_responsavel.php');
        die();
    }
?>