<?php
 include_once("conexao.php");
 $sql = "SELECT id_material, especificacao, acessorio FROM etec_materiais";
 $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Materiais</title>
</head>
<body>
    <a href="cadastrar_tombo.php"><input type="button" value="Cadastrar Tombo"></a>
    <a href="Guia_transito/guias_transito.php"><input type="button" value="Guias de transito"></a>
    <a href="tombos.php"><input type="button" value="Tombos"></a>
    <a href="cadastrar_material.php"><input type="button" value="Cadastrar material"></a>
    <table border=1>
        <tr>
            <th>Especificação</th>
            <th>Acessórios</th>
        </tr>
        <?php 
        while($row = mysqli_fetch_array($result)){
            echo'<tr>
            <td>'.$row['especificacao'].'</td>
            <td>'.$row['acessorio'].'</td>
            <td>
                    <form action="editar_material.php" method="POST">
                        <button type="submit" value="'.$row['id_material'].'" name="editar">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="controle/processo_material.php" method="POST">
                        <button type="submit" value="'.$row['id_material'].'" name="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>';
        }
        ?>
    </table>
</body>
</html>