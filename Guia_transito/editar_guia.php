<?php
include_once("../conexao.php");
//$id = $_POST['idGuia'];
$id = 1;
$sql = "SELECT g.stats, g.entregador, g.destinatario, id_tombos FROM etec_guias_lab g 
        WHERE id_guia = $id";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Guia</title>
</head>
<body>
    <form action="../controle/processo_guia.php" method="post">
        <table border = 1>
            <tr>
                <th>Status</th>
                <th>Entregador</th>
                <th>Destinatario</th>
            </tr>
            <tr>
                <td>
                    <?php
                        echo '<select name="estado">
                                    <option value="ENTREGUE">ENTREGUE</option>
                                    <option value="ESPERANDO">ESPERANDO</option>      
                                </select>';
                    ?>
                </td>
                <?php
                    echo '<td> <input type="text" name="entregador" value="'.$row['entregador'].'"></td>
                        <td> <input type="text" name="destinatario" value="'.$row['destinatario'].'"></td>';
                ?>
            </tr>
        </table>
        <input type="hidden" name="Atualizar" value="<?=$id?>">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>