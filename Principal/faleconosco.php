<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Fale Conosco</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>
    <link rel="stylesheet" href="../CSS/estilo.css">
    <link rel="stylesheet" href="../CSS/formularios.css">
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
  <br>
  
  <div id="interface">
      
<form action="faleconosco.php" name = "home" method="POST">
  <header id="cabecalho">
    <figure class="logo-site">
      <img id="icone" src="../Imagens/logo.png" alt="logo do site">

          <fieldset id="mensagem"> <legend><h1> Fale Conosco</h1></legend>
          <br>
          <br>
             <h6 for="curgencia"> Grau de Urgência:</h6> 
             Min <input type="range" id="points" name="urgencia" id="curgencia" name="points" min="0" max="10"> Máx
             <br>
             <br>
            <h6 for="cmensagem">Deixe seu recado:</h6>
              <div class="form-floating">
                <input t ype="textarea" class="form-control" name="mensagem" id="cmensagem" placeholder="Deixe seu recado aqui..." style="height: 100px"></input>
                <br>
                <a href="" type="submit" class="btn btn-dark btn-lg" name="cadastrar" style="background-color: rgb(82, 59, 26);" data-bs-toggle="modal" data-bs-target="#modalsenha">Salvar as Informações</a>
            
<form action="../Principal/Menupet.php" name="menupets" method="POST">
  <div class="modal fade" id="modalsenha" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Confirme</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Antes de salvar o perfil do seu pet, confirme com sua senha de cadastro!<h11>*</h11> </h6>
          <div class="row">
            <div class="col">
              <input type="password" class="form-control" placeholder="Digite sua senha aqui..." aria-label="senha">
            </div>
          </div>
          <br>
          <img src="../Imagens/cutecat.gif">
        </div>
        <h6>Campo Obrigatório<h11>*</h11> </h6>
<br>
        <div class="modal-footer">
        <a href="../Principal/Menuresp.php" class="btn btn-dark btn-lg " style="background-color:  rgb(160, 134, 87);">Confirmar</a>
        </div>
      </div>
    </div>
  </div>
  </form>
          </fieldset>
          <br>
      <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
  </div>
</body>
</html>