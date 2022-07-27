<?php
include("../Cadastros/Conexao_BD.inc.php");
session_start();
//Pegando os valores do FORM
$login = $_POST["login"];
$senha = $_POST["senha"];

//Indo pegar as infos do BD
$sql = "SELECT Resp_login, Resp_senha, Resp_cpf, Resp_status FROM responsavel";
$query = mysqli_query($conexao, $sql);


while($row = mysqli_fetch_assoc($query)) {
    if($row["Resp_login"] == $login && $row["Resp_senha"] == $senha){
        if($row["Resp_status"] == 'Ativo'){
        $_SESSION["Resp_cpf"] = $row["Resp_cpf"];
        $_SESSION["Resp_login"] = $row["Resp_login"];
        header('Location: ../Principal/Menuresp.php');
        die();
        } else if($row["Resp_status"] == 'Inativo'){
            header('Location: ../Reativar/Reativar_responsavel.php');
            die();
        }
    } else {
        $_SESSION["errado"] = "errado";
        $_SESSION["error"] =  mysqli_error($conexao);
        header('Location: Login_resp.php');
    }
}

?>