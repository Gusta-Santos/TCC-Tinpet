<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Informações do responsável</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>

    <!--Pegando infos para o sweetalert-->
    <script src="../Bootstrap/js/sweetalert2.all.min.js"></script>
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <!----------------------------------->

    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
    <?php session_start();?>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(206, 186, 149);">
    <div class="container-fluid">
      <img src="../Imagens/logo2new.png" width="100" height="50" style="margin-right: 15px;" class="d-inline-block align-top">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <img src="../Imagens/responsavel.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Principal/Menuresp.php">Menu responsável</a>
          </li>
          <img src="../Imagens/relacao.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Relacao/Menurelacao.php">Menu de relações</a>
          </li>
        </ul>
        <span class="navbar-brand" float="right">
            <img src="../Imagens/user.png">
            Olá, <?php echo $_SESSION["Resp_login"];?>
        </span>
        <button type="button" class="btn btn-dark" style="background-color: rgb(82, 59, 26);">
        <a style="text-decoration: none; color: white;" href="../Principal/Home.html">Sair</a>
        </button>
      </div>
    </div>
    </nav>

    <?php
    //Pegando informações do GET e incluindo a conexão com o BD
    include("../Cadastros/Conexao_BD.inc.php");
    $cod = $_GET["cod"];
    $codpet = $_GET["codpet"];
    ?>

    <div class="container">
        <picture>
        <img style="display: block; margin-left: auto; margin-right: auto;" src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <h1 style="text-align: center; margin-bottom: 2%; font-size: 40px">Informações sobre o responsável</h1>
        <p style="text-align: center;">Utilize as informações aqui presentes para entrar em contato com o outro responsável e decidir como vai ser a relação dos seus bichinhos!</p>
        <div class="infopetsdados">
            <?php
            $sql = "SELECT * FROM animal, responsavel WHERE Pet_codigo='$codpet' AND animal.Resp_cpf = responsavel.Resp_cpf";
            $query = mysqli_query($conexao, $sql);
            while($row = mysqli_fetch_assoc($query)){
            $telefone = Mask("(##) #####-####",$row["Resp_telefone"]);
            ?>
            <!--nome, email, telefone, estado, cidade, bairro-->
            <div class="row mx-auto">
                <div class="col-lg-4">
                <h7><b>Nome:</b><br> <?php echo $row["Resp_nome"]?></h7>
                </div>
                <div class="col-lg-4">
                <h7><b>Email:</b><br>  <?php echo $row["Resp_email"]?></h7>
                </div>
                <div class="col-lg-4">
                <h7><b>Telefone:</b><br>  <?php echo $telefone?></h7>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="col-lg-4">
                <h7><b>Estado:</b><br>  <?php echo $row["Resp_estado"]?></h7>
                </div>
                <div class="col-lg-4">
                <h7><b>Cidade:</b><br>  <?php echo $row["Resp_cidade"]?></h7>
                </div>
                <div class="col-lg-4">
                <h7><b>Bairro:</b><br>  <?php echo $row["Resp_bairro"]?></h7>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

    </div>
    <?php
    function Mask($mask,$str){

        $str = str_replace(" ","",$str);
    
        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
    
        return $mask;
    
    }
    ?>
</body>
</html>