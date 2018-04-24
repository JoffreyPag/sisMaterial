<?php
include_once("../conexao.php");
$guiaID  = $_POST['guia'];
$tipo = $_POST['tipo'];
$sql = "SELECT d.nome, e.nome, p.municipio, p.cidade, o.municipio, o.cidade, m.especificacao, g.responsavel, g.justificativa, g.numero_tombo, g.quantidade, g.entregador, g.destinatario, g.dia, g.mes, g.ano, g.stats 
        FROM etec_guias g
        LEFT OUTER JOIN etec_departamento d ON g.id_origem = d.id_departamento
        LEFT OUTER JOIN etec_departamento e ON g.id_destino = e.id_departamento
        LEFT OUTER JOIN etec_polo p ON d.idpolo = p.idpolo
        LEFT OUTER JOIN etec_polo o ON e.idpolo = o.idpolo
        LEFT OUTER JOIN ".(($tipo=='consumo')? "etec_materiais_consumo m ON g.id_material = m.id_consumo" : "etec_materiais_permanentes m ON g.id_material = m.id_permanente") ."  
        WHERE g.id_guia = $guiaID";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
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
    ?>
</table>
<table>
    <tr>
        <th>
            <?php 
                if($row['stats'] != "ENTREGUE"){
                    echo '<form action="editar_guia.php" method="POST">
                            <input type="hidden" name="idGuia" value="'.$guiaID.'">
                            <input type="hidden" name="tipo" value="'.$tipo.'">
                            <input type="submit" value="Editar" value="Editar">
                        </form>';
                }else{

                }
            
            ?>
            
        </th>
        <th>
            <form action="../controle/processo_guia.php" method="POST">
                <input type="hidden" name="idguia" value="<?=$guiaID?>">
                <!--EDITAR AQUI -->
                <input type="submit" name="Excluir" value="Excluir">
            </form>
        </th>
    </tr>
</table>
</body>
</html>