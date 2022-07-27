<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Menu pet</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>
    <link rel="stylesheet" href="../CSS/Estilo_cadastros.css">
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
    <?php session_start();?>
    <!--Nav bar -->
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
          <img src="../Imagens/alterar.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Alteracoes/Alterar_animal.php">Alterar pet</a>
          </li>
          <img src="../Imagens/excluir.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Exclusoes/Excluir_animal.php">Inativar pet</a>
          </li>
          <img src="../Imagens/filtro.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Filtros/Filtrar_pets.php">Encontrar parceiro</a>
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
        <a style="text-decoration: none; color: white;" href="../Principal/Logout.php">Sair</a>
        </button>
      </div>
    </div>
  </nav>
    <!--Pegando as infos do pet para mostrar-->
    <?php
    include("../Cadastros/Conexao_BD.inc.php");
    if(isset($_POST["codigo"])){
      $cod = $_POST["codigo"];
      $_SESSION["Pet_codigo"] = $cod;
    } else {
      $cod = $_SESSION["Pet_codigo"];
    }
    $sql = "SELECT * FROM animal WHERE Pet_codigo = $cod";

    $query = mysqli_query($conexao, $sql);
    while($row = mysqli_fetch_assoc($query)){
    ?>
   <div id="interface">
        <picture>
        <img src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <legend><h1>Informações do Pet:</h1></legend>
    <div class="container" class="centered">
      <br>
    <img id="imgmenupet" src="../Cadastros/Dados_animal/<?php echo $row["Pet_imagem"]?>">
    
    <aside id="lateral">
    <div class="dadospets">
    <h6 id="labelpets">Código:</h6><p><?php echo $row["Pet_codigo"]?></p><br>
    <h6 id="labelpets">Nome:</h6><p><?php echo $row["Pet_nome"]?></p><br>
    <h6 id="labelpets">Tipo:</h6><p><?php echo $row["Pet_tipo"]?></p><br>
    <h6 id="labelpets">Raça:</h6><p><?php echo $row["Pet_raca"]?></p><br>
    <h6 id="labelpets">Cor:</h6><p><?php echo $row["Pet_cor"]?></p><br>
    <h6 id="labelpets">Sexo:</h6><p><?php echo $row["Pet_sexo"]?></p><br>
    <h6 id="labelpets">Porte:</h6><p><?php echo $row["Pet_porte"]?></p><br>
    <h6 id="labelpets">Vacinado:</h6>
    <?php
    if($row["Pet_vacina"] == 1){
        echo"<p>Sim</p><br>";
    } else {
        echo"<p>Não</p><br>";
    }
    ?> 
    <h6 id="labelpets">Data vacina:</h6><p><?php echo date('d/m/Y', strtotime($row["Pet_vacdata"]))?></p><br>
    <h6 id="labelpets">Adestrado:</h6>
    <?php
    if($row["Pet_ades"] == 1){
        echo"<p>Sim</p><br>";
    } else {
        echo"<p>Não</p><br>";
    }
    ?> 
    <h6 id="labelpets">Número do pedigree:</h6><p><?php echo $row["Pet_pednum"]?></p><br>
    <h6 id="labelpets">Data de nascimento:</h6><p><?php echo date('d/m/Y', strtotime($row["Pet_data"]))?></p><br>
   
    <h6 id="labelpets">Observações:</h6><p><?php echo $row["Pet_obs"]?></p><br>
    </div>
    <a href="../Filtros/Filtrar_pets.php"><button class="btn btn-dark btn-lg" style="background-color: rgb(82, 59, 26);">Encontrar parceiro</button></a>
    </div>
  </aside> 
    
    <?php
    }
    ?>
    <br>
    
    <footer id="rodape">  
      Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
    <br>
  </div>
</body>
</html>