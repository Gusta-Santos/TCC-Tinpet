<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Registrar animal</title>
</head>
<body>
    <?php
        include("Conexao_BD.inc.php");
        // Criando variáveis pra salvar o que veio do form
        $cpfresp = $_POST["cpf"];
        $nome = $_POST["nome"];
        $tipo = $_POST["tipo"];
        $raca = $_POST["raca"];

        $porte = $_POST["porte"];
        $cor = $_POST["cor"];
        $sexo = $_POST["sexo"];
        $vacina = $_POST["vacina"];

        // Arrumando o formato da data pra botar no BD
        
        $datavacina = $_POST["datavacina"];
        if($datavacina != ""){
        $datavacina = "'".$datavacina."'";
        } else {
            $datavacina = "null";
        }

        $adestrado = $_POST["adestrado"];

        $pedigree = $_POST["pedigree"];

        if($_POST["pednum"]!=""){
        $pednum = $_POST["pednum"];
        $pednum = "'".$pednum."'";
        } else {
            $pednum = "null";
        }
        // Arrumando o formato da data pra botar no BD
        $datanascimento = $_POST["datanascimento"];
        if($datanascimento != ""){
        $datanascimento = "'".$datanascimento."'";
        } else {
            $datanascimento = "null";
        }

        $observacoes = $_POST["obs"];

        if(isset($_FILES["carteiravac"])){
            $extensao_carteiravac = strtolower(substr($_FILES['carteiravac']['name'], -4)); //Pega extensão do arquivo
            $nova_carteiravac = md5(time()) . $extensao_carteiravac; //Define o nome do arquivo
            $diretorio = "Dados_animal/"; //Define o diretorio para onde enviaremos o arquivo

            move_uploaded_file($_FILES['carteiravac']['tmp_name'], $diretorio.$nova_carteiravac); //Efetua o upload
            $nova_carteiravac = "'" . $nova_carteiravac . "'";
        } else {
            $nova_carteiravac= null;
        }

        if(isset($_FILES["certidao"])){
        $extensao_certidao = strtolower(substr($_FILES['certidao']['name'], -4)); //Pega extensão do arquivo
        $nova_certidao = md5(time()) . $extensao_certidao; //Define o nome do arquivo
        $diretorio = "Dados_animal/"; //Define o diretorio para onde enviaremos o arquivo
        
        move_uploaded_file($_FILES['certidao']['tmp_name'], $diretorio.$nova_certidao); //Efetua o upload
        $nova_certidao = "'" . $nova_certidao . "'";
        } else {
            $nova_certidao = null;
        }

        if(isset($_FILES["fotoanimal"])){
        $extensao_fotoanimal = strtolower(substr($_FILES['fotoanimal']['name'], -4)); //Pega extensão do arquivo
        $nova_fotoanimal = md5(time()) . $extensao_fotoanimal; //Define o nome do arquivo
        $diretorio = "Dados_animal/"; //Define o diretorio para onde enviaremos o arquivo

        move_uploaded_file($_FILES['fotoanimal']['tmp_name'], $diretorio.$nova_fotoanimal); //Efetua o upload
        $nova_fotoanimal = "'" . $nova_fotoanimal . "'";
        } else {
            $nova_fotoanimal = null;
        }
        
        $sql = "INSERT INTO animal (Pet_codigo, Resp_cpf, Pet_nome, Pet_tipo, Pet_raca, Pet_cor, Pet_sexo, Pet_porte, Pet_status, Pet_dispo,
        Pet_vacina, Pet_vacdata, Pet_ades, Pet_pedigree, Pet_pednum, Pet_carteiravac,Pet_certidao, Pet_obs, Pet_data, Pet_imagem)
        VALUES (null, '$cpfresp', '$nome', '$tipo', '$raca', '$cor', '$sexo', '$porte', 'Ativo', '1','$vacina', $datavacina, '$adestrado',
        '$pedigree', $pednum, $nova_carteiravac,$nova_certidao, '$observacoes',$datanascimento, $nova_fotoanimal)";

        session_start();
        if (mysqli_query($conexao, $sql)){
            $_SESSION["certo"] = "certo";
            header('Location: Cadastro_animal.php');
        } else {
            $_SESSION["errado"] = "errado";
            $_SESSION["error"] =  "Error: ".$sql."<br>".mysqli_error($conexao);
            header('Location: Cadastro_animal.php');
        }

    ?> 
</body>
</html>