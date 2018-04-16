<?php
    include_once("conexao.php");
    $idMaterial = $_POST['editar'];
    $tipo = $_POST['tipoMaterial'];
    if( $tipo == "permanente"){
        $sql = "SELECT id_permanente, especificacao, acessorio FROM etec_materiais_permanentes WHERE id_permanente = '$idMaterial'";
    }else{
        $sql = "SELECT id_consumo, quantidade, especificacao ,id_departamento FROM etec_materiais_consumo WHERE id_consumo = '$idMaterial'";
    }
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
                <?php
                    if( $tipo == "permanente"){
                        echo '<th>Acessório(s)</th>
                                <td><input type="text" name="Acessorios" value="'.$row['acessorio'].'" required/></td>';
                    }else{
                        echo '<th>Quantidade</th>
                                <td><input type="number" name="quantidade" value="'.$row['quantidade'].'" min="0"></td>';
                    }
                ?>
                
            </tr>
            <tr>
                <td colspan="2">
                <input type="hidden" name="tipoMaterial" value="<?= $tipo=="permanente"? 'permanente' : 'consumo'?>">
                <button type="submit" value="<?=$tipo=="permanente"? $row['id_permanente'] : $row['id_consumo'] ?>" name="Atualizar">Atualizar</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>