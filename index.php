<?php
 include_once("conexao.php");
 include_once("Modelo/Permanente.php");
 $sqlPermanente = "SELECT id_permanente, especificacao, acessorio FROM etec_materiais_permanentes";
 $sqlConsumo = "SELECT m.id_consumo, m.quantidade, m.especificacao , d.nome FROM etec_materiais_consumo m
                INNER JOIN etec_departamento d WHERE m.id_departamento = d.id_departamento";
 $resultPermanente = $conn->query($sqlPermanente);
 $resultadoConsumo = $conn->query($sqlConsumo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materiais</title>
</head>
<body>
    <a href="cadastrar_tombo.php"><input type="button" value="Cadastrar Tombo"></a>
    <a href="Guia_transito/guias_transito.php"><input type="button" value="Guias de transito"></a>
    <a href="tombos.php"><input type="button" value="Tombos"></a>
    <a href="cadastrar_material.php"><input type="button" value="Cadastrar material"></a>
    <a href="Materiais_consumo/"><input type="button" value="Requisição de materiais"></a>
    <h3>Materiais Permanentes cadastrados</h3>
    <table border=1>
        <tr>
            <th>Especificação</th>
            <th>Acessórios</th>
        </tr>
        <?php 
        while($row = mysqli_fetch_array($resultPermanente)){
            echo'<tr>
            <td>'.$row['especificacao'].'</td>
            <td>'.$row['acessorio'].'</td>
            <td>
                    <form action="editar_material.php" method="POST">
                        <input type="hidden" name="tipoMaterial" value="permanente">
                        <button type="submit" value="'.$row['id_permanente'].'" name="editar">Editar</button>
                    </form>
                </td>
                <!-- NO MOMENTO NÃO É BOM USAR ISSO AQUI
                <td>
                    <form action="controle/processo_material.php" method="POST">
                        <input type="hidden" name="tipoMaterial" value="permanente">
                        <button type="submit" value="'.$row['id_permanente'].'" name="Excluir">Excluir</button>
                    </form>
                </td>
                -->
            </tr>';
        }
        ?>
    </table>
    <br>
    <h3>Materiais de consumo cadastrados</h3>
    <table border=1>
        <tr>
            <th>Especificação</th>
            <th>Quantidade</th>
            <th>Local</th>
        </tr>
        <?php 
        while($row = mysqli_fetch_array($resultadoConsumo)){
            echo'<tr>
            <td>'.$row['especificacao'].'</td>
            <td>'.$row['quantidade'].'</td>
            <td>'.$row['nome'].'</td>
            <td>
                    <form action="editar_material.php" method="POST">
                        <input type="hidden" name="tipoMaterial" value="consumo">
                        <button type="submit" value="'.$row['id_consumo'].'" name="editar">Editar</button>
                    </form>
                </td>
                <!-- NO MOMENTO NÃO É BOM USAR ISSO AQUI
                <td>
                    <form action="controle/processo_material.php" method="POST">
                        <input type="hidden" name="tipoMaterial" value="consumo">
                        <button type="submit" value="'.$row['id_consumo'].'" name="Excluir">Excluir</button>
                    </form>
                </td>
                -->
            </tr>';
        }
        ?>
    </table>
</body>
</html>