<?php
include_once("../conexao.php");
//EDITAR AQUI
$sqlpermanente = "SELECT id_permanente, especificacao, acessorio FROM etec_materiais_permanentes";
$sqlconsumo = "SELECT id_consumo, especificacao, quantidade, id_departamento FROM etec_materiais_consumo";
$resultadopermanente = $conn->query($sqlpermanente);
$resultadoconsumo = $conn->query($sqlconsumo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novo guia</title>
</head>
<body>
    <h4>Selecione o material</h4>
        <table>
            <tr>
                <th colspan=2> Materiais Permanentes</th>
            </tr>
            <tr>
                <th>Especificação</th>
                <th>Acessorio</th>
            </tr>
            
            <?php
                while($row = mysqli_fetch_array($resultadopermanente)){
                    echo '<tr>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.$row['acessorio'].'</td>
                            <td>
                                <form action="novoGuiaet2.php" method="POST">
                                    <button type="submit" value="'.$row['id_permanente'].'" name="escolhido">Solicitar</button>
                                </form>
                            </td>
                            </tr>';
                }
            ?>
            <tr>
                <th colspan=2>Materias de Consumo</th>
            </tr>
            <tr>
                <th></th>
                <th>Quantidade</th>
            </tr>
            <?php
                while($row = mysqli_fetch_array($resultadoconsumo)){
                    echo '<tr>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.$row['quantidade'].'</td>
                            <td>
                                <form action="novoGuiaet3.php" method="POST">
                                    <input type="hidden" name="dp" value="'.$row['id_departamento'].'">
                                    <button type="submit" value="'.$row['id_consumo'].'"name="escolhido">Solicitar</button>
                                </form>
                            </td>
                            </tr>';

                }
            ?>
        </table>
        <?php echo '<a href="guias_transito.php">Cancelar</a>'?>
        
</body>
</html>