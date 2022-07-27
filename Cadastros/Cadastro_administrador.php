<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Cadastro administrador</title>
    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>

    <!--Script para fazer máscaras-->
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <!------------------------------>

    <!--Pegando infos para o sweetalert-->
    <script src="../Bootstrap/js/sweetalert2.all.min.js"></script>
    <!----------------------------------->

    <link rel="stylesheet" href="../CSS/estilo.css">
    <link rel="stylesheet" href="../CSS/formularios.css">
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
                <img src="../Imagens/adm.png" width="20" height="20" class="imagem">
                <li class="nav-item">
                    <a class="nav-link active" href="../Principal/Menuadm.php">Menu administrador</a>
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
    <!--FORMS que envia os dadis-->
    <div id="interface">
    <picture>
    <img src="../Imagens/logo.png" alt="logo do site">
    </picture>
    <fieldset id="cadastro"> <legend><h1> Cadastro Administrador:</h1></legend>

    <?php
    //Aparecer o botãozinho dizendo se funcionou ou não
    if(isset($_SESSION["certo"])){
        if($_SESSION["certo"] == "certo"){
        ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: 'Cadastro realizado com sucesso!',
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
                    title: 'Não foi possível realizar o cadastro',
                    text: 'Por favor, tente novamente',
                })
                </script>
            <?php
            /*if($_SESSION["error"] != ""){
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="botaoaviso">
                <strong> '. $_SESSION["error"] .'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }*/
        }
        $_SESSION["error"] = "";
        $_SESSION["errado"] = "";
    }
    if(isset($_SESSION["validacao"])){
        if($_SESSION["validacao"] == "erro"){
            ?>
                <script>
                Swal.fire({
                    icon: 'warning',
                    title: '<?php echo $_SESSION["errovalidacao"] ?>',
                    text: 'Por favor, tente novamente',
                })
                </script>
            <?php
        }
        $_SESSION["validacao"] = "";
    }
    ?>

    <form name="cadastro_adm" action="Registrar_administrador.php" method="POST" onsubmit="return validaForm(this);">
        <br>
    <div class="row"> 
        <div class="col"> <h6>Nome Completo:<h11>*</h11></h6>
            <input type="text" class="form-control" name="nome" placeholder="Digite seu nome completo aqui..." aria-label="name" required>
        </div>
        <div class="col">  <h6>CPF:<h11>*</h11></h6>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF aqui..." aria-label="cpf" required>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col"> <h6> Endereço de Email:<h11>*</h11></h6>
             <input type="text" class="form-control" name="email" placeholder="Digite seu email aqui..." aria-label="email" required>
        </div>
        <div class="col"> <h6> Login:<h11>*</h11></h6>
            <input type="text" class="form-control" name="login"  placeholder="Digite seu login aqui..." aria-label="login" required>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col"><h6> Senha:<h11>*</h11></h6>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha aqui..." aria-label="senha" required>
                <div id="passwordHelpBlock" class="form-text"> Sua senha deve ter de 8 a 20 caracteres, conter letras e números e não deve conter espaços, caracteres especiais ou emoji.
                </div>
        </div>
        <div class="col"><h6> Confirmar Senha:<h11>*</h11></h6>
            <input type="password" class="form-control" id="confsenha" name="confsenha" placeholder="Confirme sua senha aqui..." aria-label="senha">
                <div id="passwordHelpBlock" class="form-text"> Sua senha deve ter de 8 a 20 caracteres, conter letras e números e não deve conter espaços, caracteres especiais ou emoji.
                </div>
        </div>
    </div>
<br>
<h6>Campo Obrigatório<h11>*</h11> </h6>
<br>
    <button type="reset" class="btn btn-dark btn-lg" name="apagar" style="background-color: rgb(82, 59, 26);">Limpas Informações</button>
    <button type="submit" class="btn btn-dark btn-lg" name="cadastrar" onclick="RemoveMaskAndSubmit()" style="background-color: rgb(82, 59, 26);">Cadastrar</button>
    </form>
    </fieldset>
    <br>
              <footer id="rodape">
                Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
            </footer>
</div>
    
    <!--Colocando máscara no CPF-->
    <script>
    $("#cpf").mask("999.999.999-99");
    </script>
    
    <script type="text/javascript">
        function validaForm(frm) {

            if(frm.senha.value == frm.confsenha.value){
            return true;
            } else {
                Swal.fire({
                        icon: 'warning',
                        title: 'As senhas não estão iguais!',
                        text: 'Por favor, tente novamente',
                })
            return false;
            }
        }

        function RemoveMaskAndSubmit() {
            $('#cpf').val($('#cpf').val().replace('.', '').replace('.', '').replace('-', ''));
            $('#formId').submit();
        }
    </script>
</body>
</html>