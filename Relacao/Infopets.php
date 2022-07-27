<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Informações dos pets</title>
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
        <img src="../Imagens/responsavel.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Principal/Menuresp.php">Menu responsável</a>
          </li>
          <img src="../Imagens/relacao.png" width="20" height="20" class="imagem">
          <li class="nav-item">
            <a class="nav-link active" href="../Relacao/Menurelacao.php">Menu de relações</a>
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
    <?php
        include("../Cadastros/Conexao_BD.inc.php");
        $codpet1 = $_GET["cod1"];
        $codpet2 = $_GET["cod2"];
    ?>
    <div class="container">
        <h1 style="text-align: center; margin: 5%;">Informações dos animais dessa relação</h1>
        <div class="row">
            <div class="col-md-6">
                <?php
                $sql = "SELECT * FROM animal WHERE Pet_codigo = $codpet1";
                $query = mysqli_query($conexao, $sql);
                while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <img class="imginfopets" src="../Cadastros/Dados_animal/<?php echo $row["Pet_imagem"]?>">
                    <h1 style="text-align: center; margin: 2%;"><?php echo $row["Pet_nome"]?></h1>
                    <div class="infopetsdados">
                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Código:</b> <?php echo $row["Pet_codigo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Tipo:</b> <?php echo $row["Pet_tipo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Raça:</b> <?php echo $row["Pet_raca"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets" style="width: 160px;"><b>Cor:</b> <?php echo $row["Pet_cor"]?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Sexo:</b> <?php echo $row["Pet_sexo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Porte:</b> <?php echo $row["Pet_porte"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Vacinado:</b> <?php
                            if($row["Pet_vacina"] == 1){
                                echo"Sim";
                            } else {
                                echo"Não";
                            }
                            ?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Data vacina:</b> <?php echo date('d/m/Y', strtotime($row["Pet_vacdata"]))?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Adestrado:</b> <?php
                            if($row["Pet_ades"] == 1){
                                echo"Sim";
                            } else {
                                echo"Não";
                            }
                            ?></h6>
                            </div>
                            <div class="col-md-6">
                            <h6 id="h6infopets"><b>Data de nascimento:<br></b><?php echo date('d/m/Y', strtotime($row["Pet_data"]))?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Número<br> pedigree:</b><br> <?php echo $row["Pet_pednum"]?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <h6><b>Observações:</b> <?php echo $row["Pet_obs"]?></h6>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="col-md-6">
            <?php
                $sql = "SELECT * FROM animal WHERE Pet_codigo = $codpet2";
                $query = mysqli_query($conexao, $sql);
                while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <img class="imginfopets" src="../Cadastros/Dados_animal/<?php echo $row["Pet_imagem"]?>">
                    <h1 style="text-align: center; margin: 2%;"><?php echo $row["Pet_nome"]?></h1>
                    <div class="infopetsdados">
                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Código:</b> <?php echo $row["Pet_codigo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Tipo:</b> <?php echo $row["Pet_tipo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Raça:</b> <?php echo $row["Pet_raca"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets" style="width: 160px;"><b>Cor:</b> <?php echo $row["Pet_cor"]?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Sexo:</b> <?php echo $row["Pet_sexo"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Porte:</b> <?php echo $row["Pet_porte"]?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Vacinado:</b> <?php
                            if($row["Pet_vacina"] == 1){
                                echo"Sim";
                            } else {
                                echo"Não";
                            }
                            ?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Data vacina:</b> <?php echo date('d/m/Y', strtotime($row["Pet_vacdata"]))?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Adestrado:</b> <?php
                            if($row["Pet_ades"] == 1){
                                echo"Sim";
                            } else {
                                echo"Não";
                            }
                            ?></h6>
                            </div>
                            <div class="col-md-6">
                            <h6 id="h6infopets"><b>Data de nascimento:<br></b><?php echo date('d/m/Y', strtotime($row["Pet_data"]))?></h6>
                            </div>
                            <div class="col-md-3">
                            <h6 id="h6infopets"><b>Número<br> pedigree:</b><br> <?php echo $row["Pet_pednum"]?></h6>
                            </div>
                        </div>

                        <div class="row">
                            <h6><b>Observações:</b> <?php echo $row["Pet_obs"]?></h6>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
</body>
</html>