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

    <h1>Relatório de responsáveis cadastrados</h1>
    <table align="center" id="responsaveis">
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
    ';
    
    
    include("Conexao_BD.inc.php");
    $sql = "SELECT * FROM responsavel WHERE Resp_status = 'Ativo' order by Resp_nome asc";
    $query = mysqli_query($conexao, $sql);
    $qtd = mysqli_num_rows($query);

    if($qtd>0){
        while ($dados = mysqli_fetch_array($query)) {
        $pagina .= "
            <tr>
            <td>$dados[Resp_cpf]</td>
            <td>$dados[Resp_nome]</td>
            <td>$dados[Resp_email]</td>
            <td>$dados[Resp_telefone]</td>
            ";
            $data = date('d/m/Y', strtotime($dados["Resp_data"]));
            $pagina .= "
            <td>$data</td>
            <td>$dados[Resp_estado]</td>
            <td>$dados[Resp_cidade]</td>
            <td>$dados[Resp_bairro]</td>
            </tr>
            
        ";
        }
        } else {
            $pagina .= " <tr><td colspan='8'>Nenhum resultado encontrado</td></tr>";
        }
        $pagina .= "<th colspan='8'>Número de responsáveis cadastrados: $qtd</th>
        </table>";
    
    $dompdf -> loadHtml($pagina);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf -> render();

    $dompdf -> stream(
        "Relatorio_resp.pdf",
        array(
            "Attachment" => false
        )
    );
?>