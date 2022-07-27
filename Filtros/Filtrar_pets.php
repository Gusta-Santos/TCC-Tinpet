<?php
include("../Cadastros/Conexao_BD.inc.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Encontrar um parceiro</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Pegando informações do bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!------------------------------------>
    
    <link rel="stylesheet" href="../CSS/Estilo_filtros.css">

    <style>
        #carregando{
            text-align: center;
            background: url('cuteloading.gif') no-repeat center;
            height: 300px;
        }
    </style>
</head>
<body>
    <?php session_start();?>
    <!--Nav bar-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(206, 186, 149);">
    <div class="container-fluid">
        <img src="../Imagens/logo2new.png" width="100" height="50" style="margin-right: 15px;"  class="d-inline-block align-top">
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
            <a style="text-decoration: none; color: white;" href="../Principal/Logout.php">Sair</a>
            </button>
        </div>
        </div>
  </nav>

    <h1 class="col-md-10">Encontre um parceiro</h1>
    <div class="container">
        <div class="row">
            <br>
            <br>
            <div class="col-md-3">
                <div class="list-group">
                    <h3>Tipo</h3>
                    <select id="tipo">
                    <option value="Todos"> Todos </option>
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
                <div class="list-group">
                    <h3>Porte</h3>
                    <select id="porte">
                    <option value="Todos"> Todos </option>
                    <option value="Mini"> Mini </option>
                    <option value="Pequeno"> Pequeno </option>
                    <option value="Medio"> Médio </option>
                    <option value="Grande"> Grande </option>
                    <option value="Gigante"> Gigante</option>
                    </select>
                </div>

                <div class="list-group">
                    <h3>Sexo</h3>
                    <select id="sexo">
                    <option value="Todos"> Todos </option>
                    <option value="M"> Macho </option>
                    <option value="F"> Fêmea </option>
                    </select>
                </div>

                <div class="list-group">
                    <h3>Adestrado</h3>
                    <select id="adestrado">
                    <option value="Todos"> Todos </option>
                    <option value="1"> Sim </option>
                    <option value="0"> Não </option>
                    </select>
                </div>

                <div class="list-group">
                    <h3>Pedigree</h3>
                    <select id="pedigree">
                    <option value="Todos"> Todos </option>
                    <option value="Nenhum"> Nenhum </option>
                    <option value="Azul"> Azul </option>
                    <option value="Verde"> Verde </option>
                    <option value="Marrom"> Marrom </option>
                    </select>
                </div>

                <div class="list-group">
                    <h3>Estado</h3>
                    <select id="estado">
                        <option value="Todos"> Todos </option>
                    <optgroup label="Região Centro-Oeste">
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

                <div class="list-group">
                    <h3>Cidade</h3>
                    <div class="input-group">
                        <input type="text" id="cidade" class="form-control" placeholder="Filtre por cidade">
                        <div class="input-group-append">
                        <button class="btn btn-secondary" id="buscar" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    <h3>Bairro</h3>
                    <div class="input-group">
                        <input type="text" id="bairro" class="form-control" placeholder="Filtre por bairro">
                        <div class="input-group-append">
                        <button class="btn btn-secondary" id="buscar2" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    <h3>Raça</h3>
                    <div class="input-group">
                        <input type="text" id="raca" class="form-control" placeholder="Filtre por raça">
                        <div class="input-group-append">
                        <button class="btn btn-secondary" id="buscar3" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <br>
                <div class="row" id="dados">

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        buscar();
        function buscar(tipo,porte,sexo,adestrado,pedigree,estado,cidade,bairro,raca){
            var action = "Registrar_filtro";
            var page = "Registrar_filtro.php";
            $.ajax ({
                type: 'POST',
                dataType:'html',
                url: page, 
                beforeSend: function(){
                    $("#dados").html('<div id="carregando" style="" ></div>');
                },
                data:{action:action, tipo:tipo, porte:porte,sexo:sexo,
                    adestrado:adestrado,pedigree:pedigree,estado:estado,cidade:cidade,bairro:bairro,raca:raca
                },
                success: function (msg){
                    $("#dados").html(msg);
                }
            })
        }

        $('#buscar').click(function(){
            buscar($("#tipo").val(),$("#porte").val(),$("#sexo").val(),$("#adestrado").val(),
            $("#pedigree").val(),$("#estado").val(),$("#cidade").val(),$("#bairro").val(),$("#raca").val());
        });
        $('#buscar2').click(function(){
            buscar($("#tipo").val(),$("#porte").val(),$("#sexo").val(),$("#adestrado").val(),
            $("#pedigree").val(),$("#estado").val(),$("#cidade").val(),$("#bairro").val(),$("#raca").val());
        });
        $('#buscar3').click(function(){
            buscar($("#tipo").val(),$("#porte").val(),$("#sexo").val(),$("#adestrado").val(),
            $("#pedigree").val(),$("#estado").val(),$("#cidade").val(),$("#bairro").val(),$("#raca").val());
        });
        $('select').on('change', function(){
            buscar($("#tipo").val(),$("#porte").val(),$("#sexo").val(),$("#adestrado").val(),
            $("#pedigree").val(),$("#estado").val(),$("#cidade").val(),$("#bairro").val(),$("#raca").val());
        })
    });
</script>
</html>
