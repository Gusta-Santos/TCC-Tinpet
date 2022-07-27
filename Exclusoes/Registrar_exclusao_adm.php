<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $cpf = $_SESSION["Adm_cpf"];
    $senha = $_POST["senha"];

    $sql1 = "SELECT Adm_senha FROM administrador WHERE Adm_cpf = '$cpf'";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false;
    while($row = mysqli_fetch_assoc($query)) {
        if($senha == $row["Adm_senha"]){
            $auxiliar = true;
        } 
    }
    
    if($auxiliar == true){
        $sql = "UPDATE administrador SET Adm_status = 'Inativo' WHERE Adm_cpf = '$cpf'";
        if (mysqli_query($conexao, $sql)){
            /*$_SESSION["certo"] = "certo";
            $_SESSION["Adm_cpf"] = $cpf;*/
            header('Location: ../Principal/Logout.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            $_SESSION["Adm_cpf"] = $cpf;
            header('Location: Excluir_administrador.php');
            die();
        }
    } else {
        $_SESSION["erradosenha"] = "erradosenha";
        header('Location: Excluir_administrador.php');
        die();
    }
?>