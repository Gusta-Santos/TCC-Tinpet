<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("../Cadastros/Conexao_BD.inc.php");

session_start();
$cod = $_SESSION["Pet_codigo"];
$cpf = $_SESSION["Resp_cpf"];

if(isset($_POST["action"])){
    $sql = "SELECT * FROM animal,responsavel WHERE animal.Pet_status = 'Ativo' AND animal.Pet_codigo != '$cod' AND animal.Resp_cpf != '$cpf' AND animal.Resp_cpf = responsavel.Resp_cpf";

    if(isset($_POST["tipo"]) && $_POST["tipo"] != "Todos"){
        $tipo_filter = $_POST["tipo"];
        $sql .= " AND Pet_tipo = '$tipo_filter'";
    }
    if(isset($_POST["porte"]) && $_POST['porte'] != "Todos"){
        $porte_filter = $_POST["porte"];
        $sql .= " AND Pet_porte = '$porte_filter'";
    }
    if(isset($_POST["sexo"]) && $_POST['sexo'] != "Todos"){
        $sexo_filter = $_POST["sexo"];
        $sql .= " AND Pet_sexo = '$sexo_filter'";
    }
    if(isset($_POST["adestrado"]) && $_POST['adestrado'] != "Todos"){
        $adestrado_filter = $_POST["adestrado"];
        $sql .= " AND Pet_ades = '$adestrado_filter'";
    }
    if(isset($_POST["pedigree"]) && $_POST['pedigree'] != "Todos"){
        $pedigree_filter = $_POST["pedigree"];
        $sql .= " AND Pet_pedigree = '$pedigree_filter'";
    }
    if(isset($_POST["estado"]) && $_POST['estado'] != "Todos"){
        $estado_filter = $_POST["estado"];
        $sql .= " AND Resp_estado = '$estado_filter'";
    }
    if(isset($_POST["cidade"])){
        $cidade = $_POST["cidade"];
        $sql .= " AND Resp_cidade LIKE '%$cidade%'";
    }
    if(isset($_POST["bairro"])){
        $bairro = $_POST["bairro"];
        $sql .= " AND Resp_bairro LIKE '%$bairro%'";
    }
    if(isset($_POST["raca"])){
        $raca = $_POST["raca"];
        $sql .= " AND Pet_raca LIKE '%$raca%'";
    }

    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);
    $output = '';
    if($qtd > 0){
        foreach($query as $row){
            $output .= '
			<div class="col-sm-4">
				<div id="divpets">
					<img src="../Cadastros/Dados_animal/'. $row['Pet_imagem'] .'" alt="" id="imgpets" class="img-responsive" >
					<h4 align="center"><strong>'. $row['Pet_nome'] .'</strong></h4>
                    <p>Tipo : '. $row['Pet_tipo'] .'</p> <br>
                    <p>Porte : '. $row['Pet_porte'] .'</p> <br>
                    <p>Sexo : '. $row['Pet_sexo'] .'</p> <br>
                    <p>Raça : '. $row['Pet_raca'] .'</p> <br><br>
                    <form action="../Relacao/Infopet.php" method="POST">
                        <input type="int" name="codigo" value=" ' .$row["Pet_codigo"]. ' "hidden>
                        <button type="submit" class="btn btn-dark btn-lg" name="Entrar" style="background-color: rgb(82, 59, 26); left:50%; margin-left: 70px;">Saber mais</button>
                    </form>
                    
				</div>
			</div>
			';
        }
    } else {
        $output .= '<h3>Nada foi encontrado</h3>';
    }
    echo $output;
}
?>
</body>
</html>