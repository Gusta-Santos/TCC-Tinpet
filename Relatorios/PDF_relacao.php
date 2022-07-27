<?php
    use Dompdf\Dompdf;
    use Dompdf\Options;

    require_once 'dompdf/autoload.inc.php';
    
    $options = new Options();
    $options -> setChroot(__DIR__);
    $options -> setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);

    $pagina = '
    
    <link rel="stylesheet" href="Estilo_relatorios.css">
    <img src="Logo.png">

    <h1>Relatório das relações cadastradas</h1>
    <table align="center" id="relacoes">
    <tr>
        <th>Código</th>
        <th>Código pet 1</th>
        <th>Código pet 2</th>
        <th>Data</th>
        <th>Status</th>
    </tr>
    ';

    include("Conexao_BD.inc.php");
    $sql = "SELECT * FROM relacao WHERE Rel_status != 'I'";
    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);
    
    if($qtd>0){
        while ($dados = mysqli_fetch_array($query)) {
        $data = date('d/m/Y', strtotime($dados["Rel_data"]));
        $pagina .= "
            <tr>
            <td>$dados[Rel_cod]</td>
            <td>$dados[Rel_codpet1]</td>
            <td>$dados[Rel_codpet2]</td>
            <td>$data</td>
            <td>$dados[Rel_status]</td>
            </tr>
        ";
        }
        } else {
            $pagina .= " <tr><td colspan='8'>Nenhum resultado encontrado</td></tr>";
        }
        $pagina .= "<th colspan='8'>Número de relações cadastradas: $qtd</th>
        </table>";

    $dompdf -> loadHtml($pagina);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf -> render();

    $dompdf -> stream(
        "Relatorio_relacao.pdf",
        array(
            "Attachment" => false
        )
    );
?>