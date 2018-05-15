<?php
include_once("../conexao.php");
$id = $_POST['id'];
$sql = "SELECT rc.id_requisicao, rc.id_consumos, rc.solicitante, rc.autorizado, rc.receptor, rc.dia, rc.mes, rc.ano, rc.stats, 
                dp.nome, po.municipio, po.cidade 
        FROM etec_requisicao_consumo rc 
        INNER JOIN etec_departamento dp ON rc.id_destino = dp.id_departamento 
        INNER JOIN etec_polo po ON po.idpolo = dp.id_departamento 
        WHERE id_requisicao = $id";
$result = $conn->query($sql);

$row = mysqli_fetch_array($result);
$sqlconsumos = "SELECT * FROM tabela_consumo WHERE id_consumos = ".$row['id_consumos'];
$result2 = $conn->query($sqlconsumos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requisição</title>
</head>
<body>
    <table border=1>
        <tr>
            <th>STATUS</th>
            <th>Destino</th>
            <th>Solitado por</th>
            <th>Autorizado por</th>
            <th>Recebido por</th>
            <th>Data</th>
        </tr>
        <tr>
            <?php 
                echo '<td>'.$row['stats'].'</td>
                    <td>'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</td>
                    <td>'.$row['solicitante'].'</td>
                    <td>'.$row['autorizado'].'</td>
                    <td>'.$row['receptor'].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>';
                    
            ?>
        </tr>
    </table>

    <table>
        <tr>
            <th>Material</th>
            <th>Quantidade</th>
        </tr>
        <!--imprimir result2 -->
    </table>
    
</body>
</html>