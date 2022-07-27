<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Menu de relações</title>
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
        <a style="text-decoration: none; color: white;" href="../Principal/Home.html">Sair</a>
        </button>
      </div>
    </div>
  </nav>
    
  <?php
    //Aparecer o botãozinho dizendo se funcionou ou não
    if(isset($_SESSION["relacao"])){
      if($_SESSION["relacao"] == "cancelar"){
        ?>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Solicitação de relação foi cancelada com sucesso!'
            })
          </script>
        <?php
      }
      if($_SESSION["relacao"] == "aceitar"){
        ?>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Solicitação de relação foi correspondida com sucesso!'
            })
          </script>
        <?php
      }
      if($_SESSION["relacao"] == "rejeitar"){
        ?>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Solicitação de relação foi rejeitada com sucesso!'
            })
          </script>
        <?php
      }
      if($_SESSION["relacao"] == "deucerto"){
        ?>
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Que bom que tudo deu certo!',
              text: 'Obrigado por usar o Tinpet'
            })
          </script>
        <?php
      }
      $_SESSION["relacao"] = "";
    }
    if(isset($_SESSION["certo"])){
      
      if($_SESSION["certo"] == "certo"){
          ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: 'Solicitação de relação foi enviada com sucesso!',
                text: 'Quando o responsável pelo outro pet tomar a decisão, você receberá um aviso por e-mail',
              })
            </script>
          <?php
      }
      $_SESSION["certo"] = "";
    }
    if(isset($_SESSION["errado"])){
      if($_SESSION["errado"] == "errorejeitar"){
        ?>
          <script>
            Swal.fire({
            icon: 'error',
            title: 'Não foi possível rejeitar a relação',
            text: 'Por favor, tente novamente',
          })
          </script>
        <?php
      }
      if($_SESSION["errado"] == "errorcancelar"){
        ?>
          <script>
            Swal.fire({
            icon: 'error',
            title: 'Não foi possível cancelar a relação',
            text: 'Por favor, tente novamente',
          })
          </script>
        <?php
      }
      $_SESSION["errado"] = "";
    }
    ?>
    <br>
    <h1 style="text-align:center;">Relações ativas</h1>
    <br>
    <h1 style="text-align:center;">Iniciadas por você</h1>
    <div class="container">
    <!--Pegando informações das relações-->
    <?php
      include("../Cadastros/Conexao_BD.inc.php");
      $petcod1 = $_SESSION["Pet_codigo"];
      
      $sql="SELECT * FROM relacao,animal WHERE Rel_codpet1='$petcod1' AND animal.Pet_codigo = relacao.Rel_codpet1 AND Rel_status!='I'";
      $query = mysqli_query($conexao, $sql);
      $qtd = mysqli_num_rows($query);
      if($qtd>0){
        while($row = mysqli_fetch_assoc($query)){
          $verificadora = false;
          ?>
          <div class="divrelacao">
            <div class="row">
              <div class="col-md-3">
              <h3 class="hrelacao">Código da relação: <?php echo $row["Rel_cod"];?> </h3>
              </div>

              <div class="col-md-3">
              <?php
              $codpet2 = $row["Rel_codpet2"];
              $sql1="SELECT Pet_nome FROM relacao,animal WHERE Rel_codpet2='$codpet2' AND animal.Pet_codigo = relacao.Rel_codpet2 ";
              $query1 = mysqli_query($conexao, $sql1);
              while($row1 = mysqli_fetch_assoc($query1)){
                $nomepet2 = $row1["Pet_nome"];
              }
              ?>
              <h3 class="hrelacao">Animais: <?php echo $row["Pet_nome"]. " e " . $nomepet2;?></h3>
              </div>
              
              <div class="col-md-3">
              <h3 class="hrelacao">Data da relação: <?php echo date('d/m/Y', strtotime($row["Rel_data"]))?> </h3>
              </div>
              
              <div class="col-md-3">
                <?php
                  if($row["Rel_status"] == "A"){
                    $verificadora = "ativa";
                    ?>
                    <h3 class="hrelacao">Status da relação: Ativa</h3>
                    <?php
                  } else if($row["Rel_status"] == "I"){
                    ?>
                    <h3 class="hrelacao">Status da relação: Inativa</h3>
                    <?php
                  } else if($row["Rel_status"] == "D"){
                    ?>
                    <h3 class="hrelacao">Status da relação: A decidir</h3>
                    <?php
                  }
                ?>
              
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align: right;">
                <form action="../Relacao/Infopets.php" method="GET">
                  <input type="int" name="cod1" value="<?php echo $row["Rel_codpet1"];?>" hidden>
                  <input type="int" name="cod2" value="<?php echo $row["Rel_codpet2"];?>" hidden>
                  <a href="../Exclusoes/Excluir_relacao.php?cod=<?php echo $row["Rel_cod"];?>&codpet=<?php echo $row["Rel_codpet2"];?>"><button type="button" class="btn" style="background-color: rgb(82, 59, 26); color: white; text-decoration: none;">Cancelar</button></a>
                  <?php 
                  if($verificadora == "ativa"){
                    ?>
                    <a href="../Relacao/Inforesp.php?cod=<?php echo $row["Rel_cod"];?>&codpet=<?php echo $row["Rel_codpet2"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Informações do outro responsável</button></a>
                    <?php
                  }
                  ?>
                  <a href="../Relacao/Infopets.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Informações dos pets</button></a>
                  <?php 
                  if($verificadora == "ativa"){
                    ?>
                    <a href="../Relacao/Deucerto.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Deu certo</button></a>
                    <?php
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <h2 style="text-align: center;">Você não iniciou nenhuma relação</h2>
        <?php
      }
    ?>
    </div>
    
    <br>

    <h1 style="text-align:center;">Iniciadas por outros</h1>
    <div class="container">
    <?php
    $sql="SELECT * FROM relacao,animal WHERE Rel_codpet2='$petcod1' AND animal.Pet_codigo = relacao.Rel_codpet2 AND Rel_status!='I'";
    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);
    if($qtd>0){
      while($row = mysqli_fetch_assoc($query)){
        $verificadora = false;
        ?>
        <div class="divrelacao">
          <div class="row">
            <div class="col-md-3">
              <h3 class="hrelacao">Código da relação: <?php echo $row["Rel_cod"];?></h3>
            </div>

            <div class="col-md-3">
            <?php
              $codpet2 = $row["Rel_codpet1"];
              $sql1="SELECT Pet_nome FROM relacao,animal WHERE Rel_codpet1='$codpet2' AND animal.Pet_codigo = relacao.Rel_codpet1 ";
              $query1 = mysqli_query($conexao, $sql1);
              while($row1 = mysqli_fetch_assoc($query1)){
                $nomepet2 = $row1["Pet_nome"];
              }
            ?>
              <h3 class="hrelacao">Animais: <?php echo $nomepet2. " e " . $row["Pet_nome"];?></h3>
            </div>

            <div class="col-md-3">
              <h3 class="hrelacao">Data da relação: <?php echo date('d/m/Y', strtotime($row["Rel_data"]))?></h3>
            </div>

            <div class="col-md-3">
              <?php
                if($row["Rel_status"] == "A"){
              ?>
                  <h3 class="hrelacao">Status da relação: Ativa</h3>
              <?php
                } else if($row["Rel_status"] == "I"){
              ?>
                  <h3 class="hrelacao">Status da relação: Inativa</h3>
              <?php
                } else if($row["Rel_status"] == "D"){
                  $verificadora = "decidir";
              ?>
                  <h3 class="hrelacao">Status da relação: A decidir</h3>
                  
              <?php
                }
              ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" style="text-align: right;">
              <form action="../Relacao/Infopets.php" method="GET">
              
                <?php
                if($verificadora == false){
                  ?>
                  <a href="../Exclusoes/Excluir_relacao.php?cod=<?php echo $row["Rel_cod"];?>&codpet=<?php echo $row["Rel_codpet1"];?>"><button type="button" class="btn" style="background-color: rgb(82, 59, 26); color: white; text-decoration: none;">Cancelar</button></a>
                  <a href="../Relacao/Inforesp.php?cod=<?php echo $row["Rel_cod"];?>&codpet=<?php echo $row["Rel_codpet1"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Informações do outro responsável</button></a>
                  <?php
                }
                ?>
                <a href="../Relacao/Infopets.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Informações dos pets</button></a>
                <?php
                if($verificadora == false){
                  ?>
                  <a href="../Relacao/Deucerto.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>"><button class="btn" type="button" style="background-color: rgb(82, 59, 26); color: white;">Deu certo</button></a>
                  <?php
                }
                ?>
                <?php
                if($verificadora == "decidir"){
                  ?>
                  <a href="../Relacao/Rejeitar_relacao.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>"><button type="button" class="btn" style="background-color: rgb(82, 59, 26); color: white; text-decoration: none;">Rejeitar</button></a>
                  <a href="../Relacao/Aceitar_relacao.php?cod=<?php echo $row["Rel_cod"];?>&cod1=<?php echo $row["Rel_codpet1"];?>&cod2=<?php echo $row["Rel_codpet2"];?>><button type="button" class="btn" style="background-color: rgb(82, 59, 26); color: white; text-decoration: none;">Aceitar</button></a>
                  <?php
                }
                ?>
                
              </form>
              
              </div>
          </div>
        </div>
        <?php
      }
    } else {
      ?>
        <h2 style="text-align: center;">Ninguém solicitou uma relação com seu animal</h2>
      <?php
    }
    ?>
    </div>
    
    <footer id="rodape">
        Copyright &copy; 2021 - by Gustavo Santos e Mª Eduarda Correia
    </footer>
    <br>
    </div>
</body>
</html>
