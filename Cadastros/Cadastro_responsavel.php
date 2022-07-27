<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Cadastro responsável</title>
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
            <img src="../Imagens/home.png" width="20" height="20" class="imagem">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../Principal/Logout.php">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <!--FORMS que envia os dados-->
    <div id="interface">
	<picture>
        <img src="../Imagens/Logo.png" alt="logo do site">
    </picture>
    <fieldset id="cadastro"> <legend><h1> Cadastre-se:</h1></legend>

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

    <form name="cadastro_resp" action="Registrar_responsavel.php" method="POST" onsubmit="return validaForm(this);">
        <br>
    <div class="row"> 
    <div class="col"> <h6>Nome Completo:<h11>*</h11></h6>
      <input type="text" class="form-control" name="nome" maxlength="50" placeholder="Digite seu nome aqui..." aria-label="name" required>
    </div>
  </div>
<br>
<div class="row">
    <div class="col"> <h6> Endereço de Email:<h11>*</h11></h6>
      <input type="text" class="form-control" name="email" maxlength="50" placeholder="Digite seu email aqui..." aria-label="email" required>
    </div>
    <div class="col"> <h6> Login:<h11>*</h11></h6>
      <input type="text" class="form-control" name="login" maxlength="30" placeholder="Digite seu login aqui..." aria-label="login" required>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col"> <h6> CPF:<h11>*</h11></h6>
      <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" placeholder="123.456.789-00" aria-label="cpf" required>
    </div>
    <div class="col"><h6> Telefone:<h11>*</h11></h6>
      <input type="text" class="form-control" id="telefone" name="telefone" maxlength="12" placeholder="(00) 12345-6789" aria-label="telefone" required>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col"> <h6> Data de nascimento:<h11>*</h11></h6>
      <input type="date" class="form-control" name="datanascimento" aria-label="nascimento" required>
    </div>
    <div class="col"><h6> Estado:<h11>*</h11></h6>
      <select id="estado" name="estado" class="form-select">
      <optgroup label="Região Centro-Oeste">
            <option  selected disabled="true">  Selecionar</option>  
            <option value="DF">  Distrito Federal</option>     
            <option value="GO">  Goiás</option> 
            <option value="MT">  Mato Grosso</option>
            <option value="MS">  Mato Grosso do Sul</option> 
            </optgroup>    
        <optgroup label="Região Norte">  
            <option value="AC">  Acre</option>  
            <option value="AP">  Amapá</option> 
            <option value="AM">  Amazonas</option>
            <option value="PA">  Pará</option>   
            <option value="RO">  Rondônia</option>
            <option value="RR">  Roraima</option>
            <option value="TO">  Tocantins</option>
        </optgroup>    
        <optgroup label="Região Nordeste"> 
            <option value="AL">  Alagoas</option>
            <option value="BA">  Bahia</option>
            <option value="CE">  Ceará</option> 
            <option value="MA">  Maranhão</option>
            <option value="PB">  Paraíba</option>
            <option value="PE">  Pernambuco</option>
            <option value="PI">  Piauí</option>     
            <option value="RN">  Rio Grande do Norte</option>
            <option value="SE">  Sergipe</option>    
        </optgroup>   
        <optgroup label="Região Sul">  
            <option value="PR">  Paraná</option> 
            <option value="RS">  Rio Grande do Sul </option> 
            <option value="SC">  Santa Catarina</option>
        </optgroup>    
        <optgroup label="Região Sudeste"> 
            <option value="ES">  Espiríto Santo</option>
            <option value="MG">  Minas Gerais</option>
            <option value="RJ">  Rio de Janeiro</option>
            <option value="SP">  São Paulo</option>
        </optgroup>
      </select>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col"><h6>Cidade:<h11>*</h11></h6>
      <input type = "text" class="form-control" name="cidade" maxlength="20" placeholder="Digite sua cidade aqui..." required>
    </div>
    <div class="col"><h6>Bairro:</h6>
      <input type = "text" class="form-control" name="bairro" maxlength="20" placeholder="Digite sua bairro aqui...">
    </div>
  </div>
  <br>
 <div class="row">
        <div class="col"><h6> Senha:<h11>*</h11></h6>
          <input type="password" class="form-control" id="senha" name="senha" maxlength="30" placeholder="Digite sua senha aqui..." aria-label="senha">
          <div id="passwordHelpBlock" class="form-text">
            Sua senha deve ter de 8 a 20 caracteres, conter letras e números e não deve conter espaços, caracteres especiais ou emoji.
              </div>
        </div>
        <div class="col"><h6> Confirmar Senha:<h11>*</h11></h6>
          <input type="password" class="form-control" id="confsenha" name="confsenha" maxlength="30" placeholder="Confirme sua senha aqui..." aria-label="senha">
          <div id="passwordHelpBlock" class="form-text">
            Sua senha deve ter de 8 a 20 caracteres, conter letras e números e não deve conter espaços, caracteres especiais ou emoji.
              </div>
            </div>
      </div>
<br>
<div class="form-check">
  <input class="form-check-input" type="checkbox" id="termos">
  <label class="form-check-label" for="flexCheckDefault">
    Li e concordo com os <b>termos de privacidade e de uso</b>.
  </label>
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
    <a type="submit" href="../Principal/termoprivacidade.html">Termo de Privacidade </a>
    <a type="submit" href="../Principal/termouso.html">Termo de Uso </a>
</footer>
</div>



<script>
  $("#telefone").mask("(99) 99999-9999");
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

    if(frm.termos.checked){
      return true;
    } else {
      Swal.fire({
        icon: 'warning',
        title: 'Por favor aceite os termos',
      })
      frm.termos.focus();
      return false;
    }
  }

  function RemoveMaskAndSubmit() {
    $("#telefone").val($('#telefone').val().replace('(', '').replace(')', '').replace(' ', '').replace('-', ''));
    $('#cpf').val($('#cpf').val().replace('.', '').replace('.', '').replace('-', ''));
    $('#formId').submit();
  }
</script>

</body>
</html>