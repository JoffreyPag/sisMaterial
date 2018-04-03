<?php
    include_once("conexao.php");
    $sql = "SELECT especificacao, acessorio FROM etec_materiais";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <a href="cadastrar_material.php"><input type="button" value="Cadastrar material"></a>
    <table>
        <tr>
            <th>Especificação</th>
            <th>Acessórios</th>
        </tr>
        
            <?php 
            while($row = mysqli_fetch_array($result)){
                echo'<tr>
                <td>'.$row['especificacao'].'</td>
                <td>'.$row['acessorio'].'</td>
                </tr>';
            }
                ?>
    </table>
</body>
</html>