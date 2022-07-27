<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Alterar responsável</title>
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

    <!--FORMS para exibir os dados que pegamos do BD com as infos do responsavel-->
    <div id="interface">
    <picture>
    <img src="../Imagens/logo.png" alt="logo do site">
    </picture>
    <h1>Alterar Responsável</h1>
<br>

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

    <?php
        include("../Cadastros/Conexao_BD.inc.php");
        $cpf = $_SESSION["Resp_cpf"];
        $sql = "SELECT * FROM responsavel WHERE Resp_cpf = '$cpf'";
        $query = mysqli_query($conexao, $sql);
        while($row = mysqli_fetch_assoc($query)) {

    ?>

    <form name="alterar_resp" action="Registrar_alteracao_resp.php" method="POST">
    <br>
    <div class="row">
        <div class="col">  <h6>CPF:<h11>*</h11></h6>
            <input type="text" class="form-control" name="cpf" aria-label="cpf" value="<?php echo $cpf ?>" readonly>
        </div>
        <div class="col"> <h6>Nome Completo:<h11>*</h11></h6>
            <input type="text" class="form-control" name="nome" aria-label="name" value="<?php echo $row["Resp_nome"]?>" required>
        </div>
        
    </div>
<br>
<div class="row">
        <div class="col"> <h6> Login:<h11>*</h11></h6>
            <input type="text" class="form-control" name="login"  aria-label="login" value="<?php echo $row["Resp_login"]?>" required>
        </div>
        <div class="col"><h6> Senha:<h11>*</h11></h6>
            <input type="password" class="form-control" name="senha" aria-label="senha" id="senha" value="<?php echo $row["Resp_senha"]?>" required>
            <input type="checkbox" id="checkbox" onclick="myFunction()"><h6>Mostrar senha</h6>
        </div>  
    </div>
    <br>
    <div class="row">
        <div class="col"> <h6> Endereço de Email:<h11>*</h11></h6>
            <input type="text" class="form-control" name="email" aria-label="email" value="<?php echo $row["Resp_email"]?>" required>
        </div>
        <div class="col"><h6> Telefone:<h11>*</h11></h6>
            <input type="text" class="form-control" name="telefone" aria-label="senha" id="telefone" value="<?php echo $row["Resp_telefone"]?>" required>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col"> <h6> Data de nascimento:<h11>*</h11></h6>
            <input type="date" class="form-control" name="datanascimento" value="<?php echo $row["Resp_data"]?>"  aria-label="nascimento" required>
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
        <div class="col"> <h6>Cidade:<h11>*</h11></h6>
        <input type = "text" class="form-control" name="cidade" maxlength="20" value="<?php echo $row["Resp_cidade"]?>" required>
        </div>
        <div class="col"><h6>Bairro:</h6>
        <input type = "text" class="form-control" name="bairro" maxlength="20" value="<?php echo $row["Resp_bairro"]?>">
        </div>
    </div>
    <br>
    <div class="col-12">
    <h6>Campo Obrigatório<h11>*</h11> </h6>
<br>
    <button type="reset" class="btn btn-dark btn-lg" name="apagar" style="background-color: rgb(82, 59, 26);">Limpar Informações</button>
    <button type="submit" class="btn btn-dark btn-lg" name="cadastrar" style="background-color: rgb(82, 59, 26);" data-bs-toggle="modal" data-bs-target="#modalsenha"> Salvar Informações</button>
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