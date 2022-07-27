<?php
include("../Cadastros/Conexao_BD.inc.php");
session_start();
//Pegando os valores do FORM
$login = $_POST["login"];
$senha = $_POST["senha"];
//Indo pegar as infos do BD
$sql = "SELECT Adm_login, Adm_senha, Adm_cpf, Adm_status FROM administrador";
$query = mysqli_query($conexao, $sql);

while($row = mysqli_fetch_assoc($query)) {
    if($row["Adm_login"] == $login && $row["Adm_senha"] == $senha){
        if($row["Adm_status"] == 'Ativo'){
            $_SESSION["Adm_cpf"] = $row["Adm_cpf"];
            $_SESSION["Adm_login"] = $row["Adm_login"];
            header('Location: ../Principal/Menuadm.php');
            die();
        } else if($row["Adm_status"] == 'Inativo'){
            header('Location: ../Reativar/Reativar_administrador.php');
            die();
        }
    } else {
        $_SESSION["errado"] = "errado";
        $_SESSION["error"] =  mysqli_error($conexao);
        header('Location: Login_adm.php');
    }
}


?>