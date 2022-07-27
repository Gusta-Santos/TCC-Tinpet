<?php
    use Dompdf\Dompdf;
    use Dompdf\Options;

    require_once 'dompdf/autoload.inc.php';
    
    $options = new Options();
    $options -> setChroot(__DIR__);
    $options -> setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);

    //<th>Data vacina</th>
    //<th>Número do pedigree</th>
    //<td>$dados[Pet_pednum]</td>
    $pagina = '
    <link rel="stylesheet" href="Estilo_relatorios.css">
    <img src="Logo.png">

    <h1>Relatório de pets cadastrados</h1>
    <table align="center">
    <tr>
        <th>Código</th>
        <th>CPF resp</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Raça</th>
        <th>Cor</th>
        <th>Sexo</th>
        <th>Porte</th>
        <th>Disponibilidade</th>
        <th>Vacina</th>
        
        <th>Adestrado</th>
        <th>Pedigree</th>
        
        <th>Data de nascimento</th>
    </tr>
    ';
    
    include("Conexao_BD.inc.php");

    $sql = "SELECT * FROM animal  WHERE Pet_status = 'ativo' order by Pet_codigo asc";
    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);

    if($qtd>0){
        while ($dados = mysqli_fetch_array($query)) {
        $pagina .= "
            <tr>
            <td>$dados[Pet_codigo]</td>
            <td>$dados[Resp_cpf]</td>
            <td>$dados[Pet_nome]</td>
            <td>$dados[Pet_tipo]</td>
            <td>$dados[Pet_raca]</td>
            <td>$dados[Pet_cor]</td>
            <td>$dados[Pet_sexo]</td>
            <td>$dados[Pet_porte]</td>
            ";
            if($dados["Pet_dispo"] == 1){
                $pagina .= "<td>Disponível</td>";
            } else {
                $pagina .= "<td>Indisponível</td>";
            }
            if($dados["Pet_vacina"] == 1){
                $pagina .= "<td>Vacinado</td>";
            } else {
                $pagina .= "<td>Não vacinado</td>";
            }
            /*
            $vacdata = date('d/m/Y', strtotime($dados["Pet_vacdata"]));
            $pagina .="
            <td>$vacdata</td>
            ";
            */
            if($dados["Pet_ades"] == 1){
                $pagina .= "<td>Sim</td>";
            } else {
                $pagina .= "<td>Não</td>";
            }
            $data = date('d/m/Y', strtotime($dados["Pet_data"]));
            $pagina .="
            <td>$dados[Pet_pedigree]</td>
            
            <td>$data</td>
            </tr>
        ";
        }
        } else {
            $pagina .= " <tr><td colspan='16'>Nenhum resultado encontrado</td></tr>";
        }
        $pagina .= "<th colspan='16'>Número de animal cadastrados: $qtd</th>
        </table>";
    $dompdf -> loadHtml($pagina);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf -> render();

    $dompdf -> stream(
        "Relatorio_animal.pdf",
        array(
            "Attachment" => false
        )
    );
?>