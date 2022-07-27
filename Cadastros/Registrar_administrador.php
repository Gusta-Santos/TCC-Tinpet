<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Registrar administrador</title>
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
        
        //Fazendo a verificação para saber se existem dados repetidos
        $sql1 = "SELECT Adm_cpf, Adm_login, Adm_email FROM  administrador";
        $query = mysqli_query($conexao, $sql1);
        $auxiliar = false;
        $validadora = "";
        while($row = mysqli_fetch_assoc($query)) {
                if($cpf == $row["Adm_cpf"]){
                    $validadora = "CPF já cadastrado <br>";
                    $auxiliar = true;
                }
                if($login == $row["Adm_login"]){
                    $validadora = $validadora . "Login já cadastrado <br>";
                    $auxiliar = true;
                }
                if($email == $row["Adm_email"]){
                    $validadora = $validadora . "E-mail já cadastrado <br>";
                    $auxiliar = true;
                }
        }
        
        if ($auxiliar == false){
            //Se der tudo certo ele vêm pra cá e dá tudo certo
            $sql = "INSERT INTO administrador (Adm_cpf,Adm_nome,Adm_login,Adm_senha,Adm_email,Adm_status)
            VALUES ('$cpf', '$nome', '$login', '$senha', '$email', 'Ativo')";
            
            if (mysqli_query($conexao, $sql)){
                $_SESSION["certo"] = "certo";
                header('Location: Cadastro_administrador.php');
            } else {
                $_SESSION["errado"] = "errado";
                $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
                header('Location: Cadastro_administrador.php');
                //echo "Error: ".$sql."<br>".mysqli_error($conexao);
            }
        } else if($auxiliar == true ){
            //Se der as infos estiveram repetida ele manda para a outra página e avisa
            $_SESSION["validacao"] = "erro";
            $_SESSION["errovalidacao"] = $validadora;
            header('Location: Cadastro_administrador.php');
        }

    ?> 
</body>
</html>