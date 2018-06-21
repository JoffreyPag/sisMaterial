<?php
include_once("../conexao.php");
$id = $_POST['Ver'];
$sqlConsumo = "SELECT especificacao, quantidade, unidade FROM etec_materiais_consumo WHERE id_departamento = $id";
$resultConsumo = $conn->query($sqlConsumo);
$sqlPermanente = "SELECT t.numero_tombo, t.numero_serie, t.id_material, p.especificacao, p.acessorio FROM etec_tombo t
                    INNER JOIN etec_materiais_permanentes p ON t.id_material = p.id_permanente
                    WHERE t.id_departamento = $id";
$resultPermanente = $conn->query($sqlPermanente);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
</head>
<body>
    <div>
        <h3>Consumo</h3>
        <table border=1>
            <tr><th>Material</th><th>Quantidade</th><th>Unidade</th></tr>
            <?php
                while($row = mysqli_fetch_array($resultConsumo)){
                    echo '<tr>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.$row['quantidade'].'</td>
                            <td>'.$row['unidade'].'</td>
                        </tr>';
                }
            ?>
        </table>
    </div>
    <div>
        <h3>Permanente</h3>
        <table border=1>
            <tr><th>Numero Tombo</th><th>Numero Serie</th><th>Especificacao</th><th>Acessorio</th></tr>
            <?php
                while($row = mysqli_fetch_array($resultPermanente)){
                    echo '<tr>
                            <td>'.$row['numero_tombo'].'</td>
                            <td>'.$row['numero_serie'].'</td>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.$row['acessorio'].'</td>
                        </tr>';
                }
            ?>
        </table>
    </div>
</body>
</html>