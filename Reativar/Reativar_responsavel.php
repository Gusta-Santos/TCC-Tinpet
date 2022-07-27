<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reativar administrador</title>
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
            <img src="../Imagens/home.png" width="20" height="20" class="imagem">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../Principal/home.html">Home</a>
            </li>
            <!--
            <img src="../Imagens/login.png" width="20" height="20" class="imagem">
            <li class="nav-item">
              <a class="nav-link active" href="../Principal/Login_adm.php">Retornar para o login</a>
            </li>
            -->
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <div id="interface">
        <picture>
        <img src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <h1>Reativando responsável</h1>
        <p style="text-align: center;">
        Anteriormente você escolheu inativar sua conta, para reativa-la<br>
        informe novamente seu antigo login e senha para a reativação
        </p>

        <?php
        //Aparecer o botãozinho dizendo se funcionou ou não
          if(isset($_SESSION["errado"])){
            if($_SESSION["errado"] == "errado"){
              ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Não foi possível realizar a reativação',
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
        if(isset($_SESSION["verificadora"])){
          if($_SESSION["verificadora"] == "verificadora"){{
            ?>
                <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'As informações inseridas estão incorretas ',
                    text: 'Por favor, tente novamente',
                })
                </script>
            <?php
          }
        }
        $_SESSION["verificadora"] = "";
        }
        ?>

        <form name="reativar" action="Registrar_reativar_resp.php" method="POST">
            <h6> Login:<h11>*</h11> </h6>
            <div class="form-floating mb-3"> 
                <input type="text" class="form-control" name="login" placeholder="name@example.com">
                <label for="floatingInput">Digite aqui seu login...</label>
            </div>
            <h6> Senha:<h11>*</h11> </h6>
            <div class="form-floating mb-3">
                <input type="password" name="senha" class="form-control" id="senha"  placeholder="Password">
                <label for="senha">Digite aqui sua senha...</label>
            </div>
            <h6>Campo Obrigatório<h11>*</h11> </h6>
            <br>
            <input type="checkbox" id="checkbox" onclick="myFunction()">Mostrar senha</br> <br>
            <button type="submit" class="btn btn-dark btn-lg" name="entrar" style="background-color: rgb(82, 59, 26);">Reativar</button> 
        </form>
    </div>
    <br>
    <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
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
</body>
</html>