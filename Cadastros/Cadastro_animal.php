<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="Tinpet" content="TinPet">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    
    <title>Cadastro animal</title>
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
        <a style="text-decoration: none; color: white;" href="../Principal/Logout.php">Sair</a>
        </button>
      </div>
    </div>
  </nav>
    <br>
    <!--FORMS que envia os dados-->
    <div id="interface">
        <picture>
        <img src="../Imagens/logo.png" alt="logo do site">
        </picture>
        <fieldset id="cadastro"> <legend><h1> Cadastrar Pet</h1></legend>

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
              }
              /*if($_SESSION["error"] != ""){
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="botaoaviso">
                <strong> '. $_SESSION["error"] .'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
              }*/
              $_SESSION["error"] = "";
              $_SESSION["errado"] = "";
          }
        ?>

        <form name="Cadastro_animal" action="../Cadastros/Registrar_animal.php" method="POST" enctype="multipart/form-data">
        <br>
    <div class="col">  <h6> CPF do Responsável:</h6>
      <input type="text" class="form-control" name="cpf" aria-label="cpf" value = "<?php echo $_SESSION["Resp_cpf"] ?>" readonly>
    </div>
    <br>
    <div class="row">
    <div class="col">  <h6> Nome do Pet:<h11>*</h11></h6>
      <input type="text" class="form-control" name="nome" placeholder="Digite o nome do pet aqui..." maxlength="50" aria-label="namepet" required>
    </div>
    <div class="col">  <h6> Porte do Pet:<h11>*</h11></h6>
        <select id="porte" name="porte" class="form-select">
            <option  selected disabled="true">  Selecionar</option>  
            <option value="Mini">  Mini</option>      
            <option value="Pequeno">  Pequeno</option>     
            <option value="Medio">  Médio</option> 
            <option value="Grande"> Grande</option>
            <option value="Gigante"> Gigante</option>
          </select>
        </div>
    </div>
<br>
<div class="row">
    <div class="col">  <h6> Tipo do Pet:<h11>*</h11></h6>
      <select id="tipo" name="tipo" class="form-select">
        <option  selected disabled="true">  Selecionar</option>    
        <option value="Cachorro">  Cachorro</option>     
        <option value="Gato">  Gato</option> 
        <option value="Roedor">  Roedor</option>    
        <option value="Iguana"> Iguana </option>
        <option value="Coelho">  Coelho</option>     
        <option value="Cavalo">  Cavalo</option> 
         <option value="Ave">  Ave</option> 
        <option value="Porco"> Porco</option>
        <option value="Tartaruga">  Tartaruga, Jabuti e Cágados</option>     
        <option value="Outro Tipo"> Outro Tipo</option>
        </select>
      </div>
    <div class="col">  <h6> Raça do Pet:<h11>*</h11></h6>
      <input type="text" class="form-control" name="raca" placeholder="Digite a raça do pet aqui..." maxlength="50" aria-label="raca" required>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">  <h6> Cor do Pet:<h11>*</h11></h6>
      <input type="text" class="form-control" name="cor" placeholder="Digite a cor do pet aqui..." maxlength="20" aria-label="corpet" required>
    </div>
    <div class="col">  <h6> Sexo do Pet:<h11>*</h11></h6>
        <select id="sexo" name="sexo" class="form-select">
            <option  selected disabled="true">  Selecionar</option>    
            <option value="M">  Macho</option>     
            <option value="F">  Fêmea</option> 
          </select>
        </div>
    </div>
<br>

<div class="row">
  <div class="col"> <h6> Data de nascimento:<h11>*</h11></h6>
    <input type="date" name="datanascimento" class="form-control" aria-label="nascimentopet">
  </div>
  <div class="col">  <h6> Adestrado:<h11>*</h11></h6>
    <select id="adestrado" name="adestrado" class="form-select">
        <option  selected disabled="true">  Selecionar</option>    
        <option value="1">  Sim</option>     
        <option value="0">  Não</option> 
      </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col">  <h6> Vacinado:<h11>*</h11></h6>
      <select id="vacinacao" name="vacina" class="form-select">
          <option  selected disabled="true">  Selecionar</option>  
          <option value="1">  Sim</option>     
          <option value="0">  Não</option> 
        </select>
      </div>
      <div class="col"> <h6> Data da última vacina:</h6>
        <input type="date" name="datavacina" class="form-control" aria-label="datavacina">
      </div>
  </div>
  <br>
  
<div class="row">
  <div class="col">  <h6> Pedigree:<h11>*</h11></h6>
      <select id="pedigree" name="pedigree" class="form-select">
            <option  selected disabled="true">  Selecionar</option>   
            <option value="Azul">  Azul</option>     
            <option value="Verde">  Verde</option> 
            <option value="Marrom">  Marrom</option>  
            <option value="Nenhum">  Nenhum</option>  
        </select>
      </div>
      <div class="col">  <h6> Número do Pedigree: </h6>
      <input type="text" name="pednum" class="form-control" placeholder="Digite o número do pedigree aqui..." maxlength="9" aria-label="pednum">
      <br>
      </div>

  <h6 for="obs">Observações do pet:</h6>
    <div class="form-floating">
    <input type="textarea" class="form-control" name="obs" id="obs" maxlength="200" placeholder="Deixe as observações do pet aqui..." style="height: 100px"></input>
    <br>
    </div>

  <div class="mb-3">
    <h6 for="formFile" class="form-label">Imagem da Carteira de Vacinação:</h6>
    <input class="form-control" type="file" name="carteiravac"  id="carteiravac">
  </div>
  <div class="mb-3">
    <h6 for="formFile" class="form-label">Imagem da Certidão do Pedigree:</h6>
    <input class="form-control" type="file" name="certidao" id="certidao">
  </div>

  <div class="mb-3">
    <h6 for="formFile" class="form-label">Imagem do Pet: <h11>*</h11></h6>
    <input class="form-control" type="file" name="fotoanimal" id="fotoanimal">
  </div>
<br>
<h6>Campo Obrigatório<h11>*</h11> </h6>
<div class="col-12">
    <button type="reset"  class="btn btn-dark btn-lg" name="apagar" style="background-color: rgb(82, 59, 26);">Limpas Informações</button>
    <button type="submit" class="btn btn-dark btn-lg" name="cadastrar" style="background-color: rgb(82, 59, 26);"> Cadastrar Informações</button>
</div>
        </form>
        </fieldset>
    <br>
            <!--MODAL
<form action="selecionarperfil.html" name="selecionarperfil" method="POST">
<div class="modal fade" id="modalsenha" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Confirme</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Antes de salvar o perfil do seu pet, confirme com sua senha de cadastro!</p>
        <div class="row">
          <div class="col">
            <input type="password" class="form-control" placeholder="Digite sua senha aqui..." aria-label="senha">
          </div>
        </div>
        <br>
        <img src="../Imagens/cutecat.gif">
      </div>
      <div class="modal-footer">
      <a href="../Principal/Menuresp.php" class="btn btn-dark btn-lg" style="background-color:  rgb(160, 134, 87);">Confirmar</a>
      </div>
    </div>
  </div>
</div>
</form>
-->

<footer id="rodape">
  Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
</footer>
</div>
    
</body>
</html>
