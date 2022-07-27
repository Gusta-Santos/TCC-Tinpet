<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Menu responsável</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>
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
        <img src="../Imagens/fale.png" width="20" height="20" class="imagem">
        <li class="nav-item">
          <a class="nav-link active" href="../Principal/faleconosco.php">Fale Conosco</a>
        </li>
        <img src="../Imagens/alterar.png" width="20" height="20" class="imagem">
        <li class="nav-item">
          <a class="nav-link active" href="../Alteracoes/Alterar_responsavel.php">Alterar Responsável</a>
        </li>
        <img src="../Imagens/excluir.png" width="20" height="20" class="imagem">
        <li class="nav-item">
          <a class="nav-link active" href="../Exclusoes/Excluir_responsavel.php">Inativar Responsável</a>
        </li>
        <img src="../Imagens/cadastro.png" width="20" height="20" class="imagem">
        <li class="nav-item">
         <a class="nav-link active" href="../Cadastros/Cadastro_animal.php">Cadastrar Pet</a>
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
    <br>
    
    <!--Pegando as informações do BD para mostrar cada pet separadinho-->
    <div id="interface2">
        <picture>
        <img src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <legend><h1> Selecione o Perfil de Pet</h1></legend>
    <div class="container" class="centered">
    <?php
    include("../Cadastros/Conexao_BD.inc.php");
    $cpf = $_SESSION["Resp_cpf"];
    $sql = "SELECT * FROM animal WHERE Resp_cpf = $cpf order by Pet_nome asc";
    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);
    while($row = mysqli_fetch_assoc($query)){
      if($row["Pet_status"] == 'Ativo'){ 
    ?>
    <div class="divpets">
      <?php echo '<img id="imgpets" src="../Cadastros/Dados_animal/'.$row["Pet_imagem"].'"/>';?>
      
      <h5 id="labelpets"> Nome: </h5><h5 id="ppets"><?php echo $row["Pet_nome"];?></h5>
      <form action="../Principal/Menupet.php" method="POST">
        <input type="int" name="codigo" value="<?php echo $row["Pet_codigo"]?>" hidden>
        <button type="submit" class="btn btn-dark btn-lg" name="Entrar" style="background-color: rgb(82, 59, 26);">Entrar</button> 
      </form>
    </div>
    <?php
      } else if($row["Pet_status"] == 'Inativo'){
    ?>
    <div class="divpets" style="background-color: #C0C0C0;">
      <?php echo '<img id="imgpets" src="../Cadastros/Dados_animal/'.$row["Pet_imagem"].'"/>';?>
      
      <h5 id="labelpets"> Nome: </h5><h5 id="ppets"><?php echo $row["Pet_nome"];?></h5>
      <form action="../Reativar/Reativar_animal.php" method="POST">
        <input type="int" name="codigo" value="<?php echo $row["Pet_codigo"]?>" hidden>
        <button type="submit" class="btn btn-dark btn-lg" name="Entrar" style="background-color: rgb(82, 59, 26);">Reativar animal</button>
      </form>
    </div>
    <?php
      }
      }
    ?>
    <div class="divpets" >
    <button type="button" id="icon_cadastrar" onclick="location.href = '../Cadastros/Cadastro_animal'"><img src="../Imagens/add_pet.png"></button>
    </div>
    </div>
    <br>
    
    <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
    <br>
    </div>
</body>
</html>
