<?php
    include_once("conexao.php");
    $idMaterial = $_POST['editar'];
    $sql = "SELECT id_material, especificacao, acessorio, isConsumo, quantidade FROM etec_materiais WHERE id_material = '$idMaterial'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Material</title>
</head>
<body>
    <form action="controle/processo_material.php" method="post">
        <table border=1>
            <tr>
                <th>Especificação</th>
                <td><input type="text" name="Especificacao" value="<?=$row['especificacao'] ?>" required/></td>
            </tr>
            <tr>
                <th>Acessório(s)</th>
                <td><input type="text" name="Acessorios" value="<?=$row['acessorio'] ?>" required/></td>
            </tr>
            <tr>
                <th>Quantidade:</th>
                <td><input type="number" name="quantidade" value="<?=$row['quantidade']?>" min="0"></td>
            </tr>
            <tr>
                <th>Tipo material:</th>
                <td><?=$row['isConsumo']? "Cosumo" : "Material Permanete"?></td>
            </tr>
            <tr>
                <td colspan="2">
                <button type="submit" value="<?=$row['id_material'] ?>" name="Atualizar">Atualizar</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>