<?php
include_once("../conexao.php");
//$guiaID  = $_POST['guia'];
$guiaID = 1;
$sql = "SELECT pd.municipio, pd.cidade, dd.nome, dor.nome, 
                g.responsavel, g.justificativa, g.entregador, g.destinatario, 
                g.dia, g.mes, g.ano, g.stats, g.id_tombos 
        FROM etec_guias_lab g 
        LEFT OUTER JOIN etec_departamento dor ON g.id_origem = dor.id_departamento 
        LEFT OUTER JOIN etec_departamento dd ON g.id_destino = dd.id_departamento 
        LEFT OUTER JOIN etec_polo pd ON dd.idpolo = pd.idpolo 
        WHERE g.id_guia = $guiaID";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$sql = "SELECT * FROM numero_tombos WHERE id_tombos = ".$row['id_tombos'];
$resultombos = $conn->query($sql);
$rowtombos = mysqli_fetch_array($resultombos);
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
            <th>Origem</th>
            <th>Destino</th>
            <th>Justificativa</th>
            <th>Responsavel</th>
            <th>Entregador</th>
            <th>Destinatário</th>
            <th>Data</th>
        </tr>
        <?php
            echo '<tr>
                    <td>'.$row['stats'].'</td>';
            //numeros de tombos
            echo   '<td>'.$row[''].'</td>';
            //materiais
            echo   '<td>'.$row[''].'</td>';
            
            echo   '<td>'.$row[3].'</td>
                    <td>'.$row[0].'/'.$row[1].'-'.$row[2].'</td>
                    <td>'.$row['justificativa'].'</td>
                    <td>'.$row['responsavel'].'</td>
                    <td>'.$row['entregador'].'</td>
                    <td>'.$row['destinatario'].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                </tr>';
        ?>
    </table>
</body>
</html>