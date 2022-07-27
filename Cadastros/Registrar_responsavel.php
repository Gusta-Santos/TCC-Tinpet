<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Registrar responsável</title>
</head>
<body>
    <?php
        //Conectando com o BD
        include("Conexao_BD.inc.php");
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
        $sql1 = "SELECT Resp_cpf, Resp_login, Resp_email FROM  responsavel";
        $query = mysqli_query($conexao, $sql1);
        $auxiliar = false;
        $validadora = "";
        while($row = mysqli_fetch_assoc($query)) {
                if($cpf == $row["Resp_cpf"]){
                    $validadora = "CPF já cadastrado <br>";
                    $auxiliar = true;
                }
                if($login == $row["Resp_login"]){
                    $validadora = $validadora . " Login já cadastrado <br>";
                    $auxiliar = true;
                }
                if($email == $row["Resp_email"]){
                    $validadora = $validadora . "E-mail já cadastrado <br>";
                    $auxiliar = true;
                }
        }
        if ($auxiliar == false){
            //Se der tudo certo ele vêm pra cá e dá tudo certo
            $sql = "INSERT INTO responsavel (Resp_cpf,Resp_nome,Resp_login,Resp_senha,Resp_email,Resp_telefone,Resp_data ,Resp_estado,
            Resp_cidade,Resp_bairro,Resp_status)
            VALUES ('$cpf', '$nome', '$login', '$senha', '$email', '$telefone', '$datanascimento','$estado','$cidade', '$bairro', 'Ativo')";
            
            if (mysqli_query($conexao, $sql)){
                $_SESSION["certo"] = "certo";
                header('Location: Cadastro_responsavel.php');
            } else {
                $_SESSION["errado"] = "errado";
                $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
                header('Location: Cadastro_responsavel.php');
            }
        } else if($auxiliar == true ){
            //Se der as infos estiveram repetida ele manda para a outra página e avisa
            $_SESSION["validacao"] = "erro";
            $_SESSION["errovalidacao"] = $validadora;
            header('Location: Cadastro_responsavel.php');
        }
    ?> 
</body>
</html>
