<?php
include_once("conexao.php");
$sql = "SELECT id_material, isConsumo, especificacao, acessorio FROM etec_materiais";
$result = $conn->query($sql);
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
                <th>Especificação</th>
                <th>Acessorio</th>
            </tr>
            
            <?php
                while($row = mysqli_fetch_array($result)){
                    echo '<tr>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.$row['acessorio'].'</td>
                            <td>'.$row['isConsumo'].'</td>
                            <td>';

                    if($row['isConsumo']==0){
                        echo '<form action="novoGuiaet2.php" method="POST">
                            <button type="submit" value="'.$row['id_material'].'" name="escolhido">Solicitar</button>
                            </form>
                            </td>
                            </tr>';
                    }else{
                        echo '<form action="novoGuiaet3.php" method="POST">
                            <button type="submit" value="'.$row['id_material'].'" name="escolhido">Solicitar</button>
                            </form>
                            </td>
                            </tr>';
                    }
                }
            ?>
        </table>
        <?php echo '<a href="guias_transito.php">Cancelar</a>'?>
        
</body>
</html>