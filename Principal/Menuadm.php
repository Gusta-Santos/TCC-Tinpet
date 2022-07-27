<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Menu administrador</title>
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
      <!--Nav bar -->
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(206, 186, 149);">
      <div class="container-fluid">
        <img src="../Imagens/logo2new.png" width="100" height="50" style="margin-right: 15px;"  class="d-inline-block align-top">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <img src="../Imagens/cadastro.png" width="20" height="20" class="imagem">
          <li class="nav-item">
              <a class="nav-link active" href="../Cadastros/Cadastro_administrador.php">Cadastrar administrador</a>
            </li>
            <img src="../Imagens/alterar.png" width="20" height="20" class="imagem">
            <li class="nav-item">
              <a class="nav-link active" href="../Alteracoes/Alterar_administrador.php">Alterar dados</a>
            </li>
            <img src="../Imagens/excluir.png" width="20" height="20" class="imagem">
            <li class="nav-item">
              <a class="nav-link active" href="../Exclusoes/Excluir_administrador.php">Inativar administrador</a>
            </li>
            <img src="../Imagens/relatorio.png" width="20" height="20" class="imagem">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Relatórios
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="../Relatorios/Rel_pets.php">Pets cadastrados</a></li>
                  <li><a class="dropdown-item" href="../Relatorios/Rel_resp.php">Responsáveis cadastrados</a></li>
                  <li><a class="dropdown-item" href="../Relatorios/Rel_relacao.php">Relações cadastradas</a></li>
                  <!--<li><a class="dropdown-item" href="">Matches</a></li>-->
                </ul>
              </li>
          </ul>
          <span class="navbar-brand" float="right">
              <img src="../Imagens/user.png">
              Olá, <?php echo $_SESSION["Adm_login"];?>
          </span>
          <button type="button" class="btn btn-dark" style="background-color: rgb(82, 59, 26);">
          <a style="text-decoration: none; color: white;" href="../Principal/Logout.php">Sair</a>
          </button>
        </div>
      </div>
    </nav>
    <br>

    <div id="interface">
    <picture>
    <img src="../Imagens/logo.png" alt="logo do site">
    </picture>
    <legend><h1> Bem-vindo Administrador</h1></legend>
    <br>
              <footer id="rodape">
                Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
            </footer>
</div>
</body>
</html>