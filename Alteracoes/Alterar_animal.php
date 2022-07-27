<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Alterar Pet</title>
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
      <!--Nav bar-->
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(206, 186, 149);">
    <div class="container-fluid">
      <img src="../Imagens/logo2new.png" width="100" height="50" style="margin-right: 15px;" class="d-inline-block align-top">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <img src="../Imagens/pata.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Principal/Menupet.php">Menu pet</a>
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
    <!--FORMS para exibir os dados que pegamos do BD com as infos do animal-->
    <br>
    <div id="interface">
    <picture>
    <img src="../Imagens/logo.png" alt="logo do site">
    </picture>
    <h1>Alterar Pet</h1>

    <?php
    //Aparecer o botãozinho dizendo se funcionou ou não
    if(isset($_SESSION["certo"])){
        if($_SESSION["certo"] == "certo"){
          ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: 'Alteração realizada com sucesso!',
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
                    title: 'Não foi possível realizar a alteração',
                    text: 'Por favor, tente novamente',
                })
                </script>
          <?php
        }
        /*
        if($_SESSION["error"] != ""){
          echo '
          <div class="alert alert-warning alert-dismissible fade show" role="alert" id="botaoaviso">
          <strong> '. $_SESSION["error"] .'</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          ';
        }
        */
        $_SESSION["error"] = "";
        $_SESSION["errado"] = "";
    }
    ?>
    
    <?php
        include("../Cadastros/Conexao_BD.inc.php");
        $codigo = $_SESSION["Pet_codigo"];
        $sql = "SELECT * FROM animal WHERE Pet_codigo = '$codigo'";
        $query = mysqli_query($conexao, $sql);
        while($row = mysqli_fetch_assoc($query)) {
    ?>
    <form name="Alterar_pet" action="Registrar_alteracao_animal.php" method="POST">
<br>
    <div class="row"> 
        <div class="col">  <h6>CPF do Responsável:</h6>
            <input type="text" class="form-control" name="cpf" aria-label="cpf" value = "<?php echo $_SESSION["Resp_cpf"] ?>" readonly>
        </div>      
    </div>
<br>

<div class="row">
    <div class="col"> <h6>Nome do Pet:<h11>*</h11></h6>
      <input type="text" class="form-control" name="nome" aria-label="name" value = "<?php echo $row["Pet_nome"]?>" required>
    </div>
    <div class="col">  <h6> Porte do Pet:<h11>*</h11> </h6>
    <select id="porte" name="porte" class="form-select">
            <option  selected disabled="true">  Selecionar</option> 
            <option value="Mini">  Mini</option>      
            <option value="Pequeno">  Pequeno</option>     
            <option value="Médio">  Médio</option> 
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
        <option value="Outro tipo"> Outro Tipo</option>
        </select>
    </div>
    <div class="col">  <h6> Raça do Pet:<h11>*</h11> </h6>
      <input type="text" class="form-control" name="raca" aria-label="raca" value = "<?php echo $row["Pet_raca"]?>" required>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col"> <h6> Cor do pet:<h11>*</h11></h6>
      <input type="text" class="form-control" name="cor" aria-label="cor" value = "<?php echo $row["Pet_cor"]?>" required>
    </div>
    <div class="col">  <h6> Sexo do Pet:<h11>*</h11> </h6>
      <input type="text" class="form-control" name="sexo" aria-label="sexo" value = "<?php echo $row["Pet_sexo"]?>" readonly>
    </div>
  </div>
  
  <br>

  <div class="row">
  <div class="col"> <h6> Data de nascimento:<h11>*</h11></h6>
    <input type="date" name="datanascimento" class="form-control" aria-label="nascimentopet" value = "<?php echo $row["Pet_data"]?>">
  </div>
  <div class="col">  <h6> Adestrado:<h11>*</h11> </h6>
    <select id="adestrado" name="adestrado" class="form-select">
        <option  selected disabled="true">  Selecionar</option> 
        <option value="1">  Sim</option>     
        <option value="0">  Não</option> 
      </select>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col">  <h6> Vacinado:<h11>*</h11> </h6>
      <select id="vacina" name="vacina" class="form-select" value = "<?php echo $row["Pet_vacdata"]?>">
          <option  selected disabled="true">  Selecionar</option>       
          <option value="1">  Sim</option>     
          <option value="0">  Não</option> 
        </select>
      </div>
      <div class="col"> <h6> Data da última vacina:<h11>*</h11></h6>
        <input type="date" name="datavacina" class="form-control" aria-label="datavacina" value = "<?php echo $row["Pet_vacdata"]?>">
      </div>
  </div>
  <br>

  <div class="row">
  <div class="col">  <h6> Pedigree:<h11>*</h11> </h6>
      <select id="pedigree" name="pedigree" class="form-select">
            <option  selected disabled="true">  Selecionar</option>  
            <option value="Azul">  Azul</option>     
            <option value="Verde">  Verde</option> 
            <option value="Marrom">  Marrom</option>  
            <option value="Nenhum">  Nenhum</option>  
        </select>
      </div>
      <div class="col">  <h6> Número do Pedigree:<h11>*</h11> </h6>
      <input type="text" name="pednum" class="form-control" aria-label="pednum" value = "<?php echo $row["Pet_pednum"]?>">
          <br>
        </div>
    <br>
    <h6 for="obs">Observações do pet:</h6>
    <div class="form-floating">
    <input type="textarea" class="form-control" name="obs" id="obs" value="<?php echo $row["Pet_obs"]?>" style="height: 100px"></input>
    <br>
    </div>

    <h6>Campo Obrigatório<h11>*</h11> </h6>
<br>
    <div class="col-12">
    <button type="reset" class="btn btn-dark btn-lg" name="apagar" style="background-color: rgb(82, 59, 26);">Limpar Informações</button>
    <button type="submit" class="btn btn-dark btn-lg" name="cadastrar" style="background-color: rgb(82, 59, 26);" data-bs-toggle="modal" data-bs-target="#modalsenha"> Salvar Informações</button>
    <br>
    <br>
</div>
    </form>
    <br>
<footer id="rodape">
    Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia 
</footer>
        </div>
    <?php
        }
    ?>
</body>
</html>