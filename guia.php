<?php
include_once("conexao.php");
$guiaID  = $_POST['guia'];
$sql = "SELECT d.nome, e.nome, p.municipio, p.cidade, o.municipio, o.cidade, m.especificacao, g.responsavel, g.justificativa, g.numero_tombo, g.quantidade, g.entregador, g.destinatario, g.dia, g.mes, g.ano, g.stats 
        FROM etec_guias g
        LEFT OUTER JOIN etec_departamento d ON g.id_origem = d.id_departamento
        LEFT OUTER JOIN etec_departamento e ON g.id_destino = e.id_departamento
        LEFT OUTER JOIN etec_polo p ON d.idpolo = p.idpolo
        LEFT OUTER JOIN etec_polo o ON e.idpolo = o.idpolo
        LEFT OUTER JOIN etec_materiais m ON g.id_material = m.id_material
        WHERE g.id_guia = $guiaID";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guia</title>
</head>
<body>
<a href="guias_transito.php">Voltar</a>
<table border=1>
    <tr>
        <th>Status</th>
        <th>Numero tombo</th>
        <th>Material</th>
        <th>Quantidade</th>
        <th>Origem</th>
        <th>Destino</th>
        <th>Justificativa</th>
        <th>Responsavel</th>
        <th>Entregador</th>
        <th>Destinatário</th>
        <th>Data</th>
    </tr>
    <?php
        while($row = mysqli_fetch_array($result)){
            echo '<tr>
                    <td>'.$row['stats'].'</td>            
                    <td>'.$row['numero_tombo'].'</td>
                    <td>'.$row['especificacao'].'</td>
                    <td>'.$row['quantidade'].'</td>
                    <td>'.$row[2].' - '.$row[3].' - '.$row[0].'</td>
                    <td>'.$row[4].' - '.$row[5].' - '.$row[1].'</td>
                    <td>'.$row['justificativa'].'</td>
                    <td>'.$row['responsavel'].'</td>
                    <td>'.$row['entregador'].'</td>
                    <td>'.$row['destinatario'].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
            </tr>';
        }
    ?>
</table>


</body>
</html>