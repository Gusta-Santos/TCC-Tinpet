<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Inativar reponsável</title>
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
        <a style="text-decoration: none; color: white;" href="../Principal/Logout.php">Sair</a>
        </button>
      </div>
    </div>
  </nav>
    <br>
    <!-- FORMS que manda as infos de exclusão do BD-->
    <div id="interface">
        <picture>
        <picture>
        <img src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <h1>Deseja realmente inativar-se do sistema?</h1>
        <br>
        <?php
    //Aparecer o botãozinho dizendo se funcionou ou não
    if(isset($_SESSION["certo"])){
        if($_SESSION["certo"] == "certo"){
          ?>
                  <script>
                    Swal.fire({
                      icon: 'success',
                      title: 'Exclusão realizada com sucesso!',
                    })
                  </script>
          <?php
        }
        $_SESSION["certo"] = "";
    }
      if(isset($_SESSION["errado"])){
        if($_SESSION["errado"] == "errado"){
          ?>
              <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Não foi possível realizar a exclusão',
                  text: 'Por favor, tente novamente',
              })
              </script>
          <?php
            /*echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="botaoaviso">
            <strong> '. $_SESSION["error"] .'</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';*/
        }
        $_SESSION["error"] = "";
        $_SESSION["errado"] = "";
    }
    if(isset($_SESSION["erradosenha"])){
      if($_SESSION["erradosenha"] == "erradosenha"){{
        ?>
                  <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'A senha está incorreta!',
                      text: 'Por favor, informe a correta',
                  })
                  </script>
        <?php
      }
    }
    $_SESSION["erradosenha"] = "";
    }
    ?>
        <form name="excluir_resp" action="Registrar_exclusao_resp.php" method="POST">
        <div class="col"><h6> Para confirmar, digite sua senha:<h11>*</h11> </h6>
          <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha aqui..." required>
          <input type="checkbox" id="checkbox" onclick="myFunction()"><h6>Mostrar senha:</h6>
        </div>  
        <button type="submit" class="btn btn-dark btn-lg" name="entrar" style="background-color: rgb(82, 59, 26);">Inativar Responsável</button> 
        </form>
        <br>
        <h6>Campo Obrigatório<h11>*</h11> </h6>
<br>
    <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
</div>
</body>
<script>
    function myFunction() {
    var x = document.getElementById("senha");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
</script>
</html>