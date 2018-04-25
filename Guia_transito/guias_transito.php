<?php
include_once("../conexao.php");

$sqlPermanente = "SELECT g.id_guia, t.numero_tombo, g.dia, g.mes, g.ano, d.nome, e.nome, g.stats, m.especificacao FROM etec_guias g
                    LEFT OUTER JOIN etec_tombo t ON g.numero_tombo = t.numero_tombo
                    LEFT OUTER JOIN etec_departamento d ON g.id_origem = d.id_departamento
                    INNER JOIN etec_departamento e ON g.id_destino = e.id_departamento
                    LEFT OUTER JOIN etec_materiais_permanentes m ON g.id_material = m.id_permanente
                    WHERE g.isConsumo = false".(isset($_POST['filtro'])?" AND g.stats = '".$_POST['filtro']."'" : "").
                    " ORDER BY id_guia DESC";
$sqlConsumo =  "SELECT g.id_guia, g.dia, g.mes, g.ano, d.nome, e.nome, g.stats, m.especificacao FROM etec_guias g
                LEFT OUTER JOIN etec_departamento d ON g.id_origem = d.id_departamento
                INNER JOIN etec_departamento e ON g.id_destino = e.id_departamento
                LEFT OUTER JOIN etec_materiais_consumo m ON g.id_material = m.id_consumo
                WHERE g.isConsumo = true".(isset($_POST['filtro'])?" AND g.stats = '".$_POST['filtro']."'" : "").
                " ORDER BY id_guia DESC";
$resultadoPermanente = $conn->query($sqlPermanente);
$resultadoConsumo = $conn->query($sqlConsumo);          
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guias de transito</title>
</head>
<body>
    <h1>Guias</h1>
    <a href="../index.php">Voltar</a>
    <!--<a href="novoGuiaet1.php"><input type="button" value="Gerar novo guia"></a> -->
    <a href="../Guia_teste/novoGuia1.php"><input type="button" value="Gerar novo guia"></a>
    <form action="guias_transito.php" method="POST">
            <select name="filtro">
                <option value="ENTREGUE">ENTREGUE</option>
                <option value="ESPERANDO">ESPERANDO</option>      
            </select>
            <input type="submit" value="Pesquisar">
        </form>
    <h3>Permanentes</h3>
    <table border=1>
        <tr>
            <th>Status</th>
            <th>Numero Tombo</th>
            <th>Material</th>
            <th>De</th>
            <th>Para</th>
            <th>Data</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($resultadoPermanente)){
            echo '<tr>
                    <td>'.$row['stats'].'</td>
                    <td>'.$row['numero_tombo'].'</td>
                    <td>'.$row['especificacao'].'</td>
                    <td>'.$row[5].'</td>
                    <td>'.$row[6].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                    <td>
                        <form action="guia.php" method="POST">
                            <input type="hidden" name="tipo" value="permanente">
                            <button type="submit" value="'.$row['id_guia'].'" name="guia">Ver mais</button>
                        </form>
                    </td>
            </tr>' ;
        }
        ?>
    </table>
    <h3>Consumo</h3>
    <table border=1>
        <tr>
            <th>Status</th>
            <th>Material</th>
            <th>De</th>
            <th>Para</th>
            <th>Data</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($resultadoConsumo)){
                echo '<tr>
                        <td>'.$row['stats'].'</td>
                        <td>'.$row['especificacao'].'</td>
                        <td>'.$row[5].'</td>
                        <td>'.$row[6].'</td>
                        <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                        <td>
                            <form action="guia.php" method="POST">
                                <input type="hidden" name="tipo" value="consumo">
                                <button type="submit" value="'.$row['id_guia'].'" name="guia">Ver mais</button>
                            </form>
                        </td>
                    </tr>';
            }
        ?>
    </table>
</body>
</html>