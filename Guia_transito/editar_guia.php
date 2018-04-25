<?php
include_once("../conexao.php");
$id = $_POST['idGuia'];
$tipo = $_POST['tipo'];
$sql = "SELECT g.stats, g.numero_tombo, g.quantidade, g.justificativa, g.entregador, g.destinatario, m.especificacao, p.municipio, p.cidade, o.municipio, o.cidade, d.nome, e.nome, e.id_departamento,".(($tipo=="consumo")?"m.id_consumo":"m.id_permanente")."  
        FROM etec_guias g 
        LEFT OUTER JOIN ".(($tipo=="consumo")? "etec_materiais_consumo m ON m.id_consumo" : "etec_materiais_permanentes m ON m.id_permanente")." = g.id_material
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
                <th>Entregador</th>
                <th>Destinatario</th>
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
                        <td> <input type="text" name="entregador" value="'.$row['entregador'].'"></td>
                        <td> <input type="text" name="destinatario" value="'.$row['destinatario'].'"></td>
                    </tr>';
            ?>
        </table>
        <?php $tempid = ($tipo == "consumo")? $row['id_consumo']: $row['id_permanente'];?>
        <input type="hidden" name="id" value="<?=$tempid?>">
        <input type="hidden" name="tipo" value="<?=$tipo?>">
        <?php
            if($tipo=="consumo"){
                echo '<input type="hidden" name="qtd" value="'.$row['quantidade'].'">';
            }else{
                
                echo '<input type="hidden" name="departamento" value="'.$row['id_departamento'].'">
                    <input type="hidden" name="ntombo" value="'.$row['numero_tombo'].'">';
            }
        ?>

        <input type="hidden" name="Atualizar" value="<?=$id?>">
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>