<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/favicon-32x32.png" type="image/x-icon">
    <title>Relatório de responsáveis</title>
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

    <!--Pegando o datatable-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"></script>
    <!----------------------->

    <link rel="stylesheet" href="../CSS/Estilo.css">
    <link rel="stylesheet" href="../CSS/Estilo_relatorios.css">
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

    <h1>Relatório de responsáveis cadastrados</h1>
    
    <div class="container mb-3 mt-3">
        <table class="table table-striped table-bordered" style="width:100%" id="relatorioresp">
            <thead>
                <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Data nascimento</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                </tr>
            </thead>

            <tbody>
            <?php
                include("../Cadastros/Conexao_BD.inc.php");
                
                $sql = "SELECT * FROM responsavel WHERE Resp_status = 'Ativo' order by Resp_nome asc";
                $query = mysqli_query($conexao, $sql);
                $qtd = mysqli_num_rows($query);
                    while ($dados = mysqli_fetch_array($query)) {
                    $data = date('d/m/Y', strtotime($dados["Resp_data"]));
                    $telefone = Mask("(##) #####-####",$dados["Resp_telefone"]);
                    echo "
                        <tr>
                        <td>$dados[Resp_cpf]</td>
                        <td>$dados[Resp_nome]</td>
                        <td>$dados[Resp_email]</td>
                        <td>$telefone</td>
                        <td>$data</td>
                        <td>$dados[Resp_estado]</td>
                        <td>$dados[Resp_cidade]</td>
                        <td>$dados[Resp_bairro]</td>
                        </tr>
                        
                    ";
                    }
                ?>
            </tbody>
        </table>
        
        <a href="./PDF_resp.php"><button class="btn btn-dark btn-lg" style=" background-color: rgb(82, 59, 26); ">Gerar PDF</button></a>
    </div>
    
    <?php
    function Mask($mask,$str){

        $str = str_replace(" ","",$str);
    
        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
    
        return $mask;
    
    }
    ?>
</body>
    <script>
        $('#relatorioresp').DataTable({
            searching: true, paging: true, info: false,

            //Traduzindo as informações do data table
            "bJQueryUI": true,
                "oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                }
        });
    </script>
</html>