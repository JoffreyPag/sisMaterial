<?php
include_once("../conexao.php");
$id = $_POST['idGuia'];
$sql = "SELECT g.stats, g.numero_tombo, g.quantidade, g.justificativa, m.especificacao, p.municipio, p.cidade, o.municipio, o.cidade, d.nome, e.nome 
        FROM etec_guias g 
        LEFT OUTER JOIN etec_materiais m ON m.id_material = g.id_material
        LEFT OUTER JOIN etec_departamento d ON d.id_departamento = g.id_origem
        LEFT OUTER JOIN etec_departamento e ON e.id_departamento = g.id_destino
        LEFT OUTER JOIN etec_polo p ON p.idpolo = d.idpolo
        LEFT OUTER JOIN etec_polo o ON o.idpolo = d.idpolo
        WHERE id_guia = $id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Guia</title>
</head>
<body>
    <form action="../controle/processo_guia.php" method="post">
        <table border=1>
            <tr>
                <th>Status</th>
                <th>Numero Tombo</th>
                <th>Material</th>
                <th>Quantidade</th>
            </tr>
                
            <?php
                echo '<tr>
                        <td>
                            <select name="estado">
                                <option value="ENTREGUE">ENTREGUE</option>
                                <option value="ESPERANDO">ESPERANDO</option>      
                            </select>
                        </td>';
                $row = mysqli_fetch_array($result);
                echo '
                        <td>'.$row['numero_tombo'].'</td>
                        <td>'.$row['especificacao'].'</td>
                        <td>'.$row['quantidade'].'</td>
                    </tr>';
            ?>
        </table>
        <input type="hidden" name="Atualizar" value="<?=$id?>">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>