<?php
include_once("../conexao.php");
$id = $_POST['idGuia'];
$sql = "SELECT stats, entregador, destinatario, id_tombos, id_destino FROM etec_guias_lab g 
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
    <form action="../controle/processoGuia.php" method="post">
        <table border = 1>
            <tr>
                <th>Status</th>
                <th>Entregador</th>
                <th>Destinatario</th>
            </tr>
            <tr>
                <td>
                    <select name="estado">
                        <option value="ESPERANDO">ESPERANDO</option>
                        <option value="ENTREGUE">ENTREGUE</option>      
                    </select>
                    
                </td>
                <?php
                    echo '<td> <input type="text" name="entregador" value="'.$row['entregador'].'"></td>
                        <td> <input type="text" name="destinatario" value="'.$row['destinatario'].'"></td>';
                ?>
            </tr>
        </table>
        <input type="hidden" name="tombos" value="<?=$row['id_tombos']?>">
        <input type="hidden" name="destino" value="<?=$row['id_destino']?>">
        <input type="hidden" name="Atualizar" value="<?=$id?>">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>