<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar alterações</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>
    <link rel="stylesheet" href="../CSS/Estilo_cadastros.css">
</head>
<body>
    <?php
    //Conectando com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    //Iniciando sessão para mostrar infomações na página de cadastro
    session_start();

    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $datanascimento = $_POST["datanascimento"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    
    //Fazendo a verificação para saber se existem dados repetidos
    $sql1 = "SELECT Resp_login, Resp_email FROM  responsavel WHERE Resp_cpf != $cpf";
    $query = mysqli_query($conexao, $sql1);
    $auxiliar = false;
    $validadora = "";
    while($row = mysqli_fetch_assoc($query)) {
            if($login == $row["Resp_login"]){
                $validadora = $validadora . " Login já cadastrado <br>";
                $auxiliar = true;
            }
            if($email == $row["Resp_email"]){
                $validadora = $validadora . " E-mail já cadastrado <br>";
                $auxiliar = true;
            }
    }
    
    if ($auxiliar == false){
        //Se der tudo certo ele vêm pra cá e dá tudo certo
        $sql = "UPDATE responsavel SET Resp_nome = '$nome', Resp_login = '$login', Resp_senha =  '$senha', Resp_email = '$email',
        Resp_telefone = '$telefone', Resp_data='$datanascimento', Resp_estado = '$estado', Resp_cidade = '$cidade', Resp_bairro = '$bairro' WHERE Resp_cpf = '$cpf'";
        if (mysqli_query($conexao, $sql)){
            $_SESSION["certo"] = "certo";
            $_SESSION["Resp_cpf"] = $cpf;
            header('Location: Alterar_responsavel.php');
            die();
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            $_SESSION["Resp_cpf"] = $cpf;
            header('Location: Alterar_responsavel.php');
            die();
        }
    } else if($auxiliar == true){
        //Se der as infos estiveram repetida ele manda para a outra página e avisa
        $_SESSION["validacao"] = "erro";
        $_SESSION["errovalidacao"] = $validadora;
        $_SESSION["Resp_cpf"] = $cpf;
        header('Location: Alterar_responsavel.php');
        die();
    }
    ?>
</body>
</html>