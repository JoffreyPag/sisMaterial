<?php
include_once("../conexao.php");
$sqlguias = "SELECT g.id_tombos, g.id_origem, g.id_destino, g.stats, g.dia, g.mes, g.ano,
                    dor.nome, pd.municipio, pd.cidade, g.id_guia 
            FROM etec_guias_lab g 
            INNER JOIN etec_departamento dor ON g.id_origem = dor.id_departamento 
            INNER JOIN etec_departamento dd ON g.id_destino = dd.id_departamento 
            INNER JOIN adm_mand_polo pd ON dd.idpolo = pd.idpolo".
            (isset($_POST['filtro'])?" WHERE g.stats = '".$_POST['filtro']."'":"").
            " ORDER BY id_guia DESC";

$resultguias = $conn->query($sqlguias);

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
    <a href="novoGuia1.php"><input type="button" value="Gerar novo guia"></a>
    <form action="guias_transito.php" method="POST">
        <select name="filtro">
            <option value="ENTREGUE">ENTREGUE</option>
            <option value="ESPERANDO">ESPERANDO</option>      
        </select>
        <input type="submit" value="Pesquisar">
    </form>
    <h3>Guias cadastrados</h3>
    <table border=1>
        <tr>
            <th>Status</th>
            <th>De</th>
            <th>Para</th>
            <th>Data</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($resultguias)){
                echo '<tr>
                        <td>'.$row['stats'].'</td>
                        <td>'.$row[7].'</td>
                        <td>'.$row[8].'/'.$row[9].'</td>
                        <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                        <td>
                            <form action="guia.php" method="POST">
                                <button type="submit" value="'.$row['id_guia'].'" name="guia">Ver mais</button>
                            </form>
                        </td>
                    </tr>';
            }
        ?>
    </table>
</body>
</html>