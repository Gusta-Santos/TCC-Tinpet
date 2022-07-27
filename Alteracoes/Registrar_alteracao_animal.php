<?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();
    $codigo = $_SESSION["Pet_codigo"];

    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    $raca = $_POST["raca"];
    $porte = $_POST["porte"];
    $cor = $_POST["cor"];
    $sexo = $_POST["sexo"];
    $vacina = $_POST["vacina"];
    $adestrado = $_POST["adestrado"];
    $pedigree = $_POST["pedigree"];
    $observacoes = $_POST["obs"];

    // Arrumando o formato da data pra botar no BD
    
    $datavacina = $_POST["datavacina"];
    if($datavacina != ""){
    $datavacina = "'".$datavacina."'";
    } else {
        $datavacina = "null";
    }

    if($_POST["pednum"]!=""){
    $pednum = $_POST["pednum"];
    $pednum = "'".$pednum."'";
    } else {
        $pednum = "null";
    }

    $datanascimento = $_POST["datanascimento"];
    if($datanascimento != ""){
    $datanascimento = "'".$datanascimento."'";
    } else {
        $datanascimento = "null";
    }


    $sql = "UPDATE animal SET Pet_nome='$nome', Pet_tipo='$tipo', Pet_raca='$raca', Pet_cor='$cor', Pet_sexo='$sexo', Pet_porte='$porte', Pet_vacina='$vacina',
    Pet_vacdata=$datavacina, Pet_ades='$adestrado', Pet_pedigree='$pedigree', Pet_pednum=$pednum, Pet_obs='$observacoes', Pet_data=$datanascimento  
    WHERE Pet_codigo=$codigo";

    
    if (mysqli_query($conexao, $sql)){
        $_SESSION["certo"] = "certo";
        header('Location: Alterar_animal.php');
        die();
    } else {
        $_SESSION["errado"] = "errado";
        $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
        header('Location: Alterar_animal.php');
        die();
    }
?>