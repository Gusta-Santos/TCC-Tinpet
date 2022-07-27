<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    
    $cpf = $_SESSION["Resp_cpf"];
    $codigo = $_SESSION["Pet_codigo"];
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
        $sql = "UPDATE animal SET Pet_status = 'Inativo', Pet_dispo = 0 WHERE Pet_codigo = '$codigo'";

        if (mysqli_query($conexao, $sql)){
            $_SESSION["certo"] = "certo";
            header('Location: Excluir_animal.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            header('Location: Excluir_animal.php');
            die();
        }
    } else {
        $_SESSION["erradosenha"] = "erradosenha";
        header('Location: Excluir_animal.php');
        die();
    }
?>