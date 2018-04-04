<?php
include_once("conexao.php");
/*$sql = "SELECT s.id_solicitacao, t.numero_tombo, s.quando, s.transportador, s.cpf , m.especificacao, d.nome, e.nome, s.stats FROM etec_solicitacoes s
        INNER JOIN etec_tombo t ON s.numero_tombo = t.numero_tombo
        INNER JOIN etec_materiais m ON t.id_material = m.id_material
        LEFT OUTER JOIN etec_departamento d ON s.estava = d.id_departamento
        INNER JOIN etec_departamento e ON s.foi = e.id_departamento";*/
$sql = "SELECT g.id_guia, t.numero_tombo, g.dia, g.mes, g.ano, d.nome, e.nome, g.stats, m.especificacao FROM etec_guias g
        LEFT OUTER JOIN etec_tombo t ON g.numero_tombo = t.numero_tombo
        LEFT OUTER JOIN etec_departamento d ON g.id_origem = d.id_departamento
        INNER JOIN etec_departamento e ON g.id_destino = e.id_departamento
        LEFT OUTER JOIN etec_materiais m ON g.id_material = m.id_material".(isset($_POST['filtro'])?" WHERE g.stats = '".$_POST['filtro']."'" : "");
$result = $conn->query($sql);         
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guias de transito</title>
</head>
<body>
    <h1>Guias</h1>
    <a href="index.php">Voltar</a>
    <a href="guias_transito.php"><input type="button" value="Gerar novo guia"></a> 
    <form action="guias_transito.php" method="POST">
            <select name="filtro" id="">
                <option value="ENTREGUE">ENTREGUE</option>
                <option value="ESPERANDO">ESPERANDO</option>      
            </select>
            <input type="submit" value="Pesquisar">
        </form>
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
        while($row = mysqli_fetch_array($result)){
            echo '<tr>
                    <td>'.$row['stats'].'</td>
                    <td>'.$row['numero_tombo'].'</td>
                    <td>'.$row['especificacao'].'</td>
                    <td>'.$row[5].'</td>
                    <td>'.$row[6].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                    <td>
                        <form action="guia.php" method="POST">
                            <button type="submit" value="'.$row['id_guia'].'" name="guia">Ver mais</button>
                        </form>
                    </td>
            </tr>' ;
        }
        ?>
    </table>
</body>
</html>