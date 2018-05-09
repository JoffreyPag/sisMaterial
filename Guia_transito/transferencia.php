<?php
include_once("../conexao.php");
    $nt = $_POST['mover'];
    $sql = "SELECT t.numero_tombo, t.id_material, m.especificacao, m.acessorio, t.id_departamento ,d.nome, p.municipio, p.cidade FROM etec_tombo t
            INNER JOIN etec_materiais_permanentes m ON t.id_material = m.id_permanente
            INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
            INNER JOIN etec_polo p ON d.idpolo = p.idpolo
            WHERE t.numero_tombo = $nt";
    $resultado = $conn->query($sql);
    $row = mysqli_fetch_array($resultado)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tranferencia</title>
</head>
<body>
    <form action="../controle/controle_transferencia.php" method="post">
        <input type="hidden" name="setorOrigem" value="<?=$row['id_departamento']?>">
        <input type="hidden" name="ntombo" value="<?=$row['numero_tombo']?>">
        <!--<input type="hidden" name="idMaterial" value="<X=$row['id_material']?>">-->
        <table border=1>
            <tr>
                <th>Setor de origem: </th>
                <td><?= $row['municipio'].' / '.$row['cidade'].' - '.$row['nome'] ?></td>
            </tr>
            <tr>
                <th>Setor de destino: </th>
                <td>
                    <?php
                        $sqlSetor = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d
                                    INNER JOIN etec_polo p ON d.idpolo = p.idpolo";
                        $resultDestino = $conn->query($sqlSetor);
                        echo '<select name="setorDestino">';
                        while($row2 = mysqli_fetch_array($resultDestino)){
                            //para evitar que alguem tente mandar um item de um setor para o mesmo setor
                            if($row2['id_departamento'] != $row['id_departamento']){
                                echo '<option value="'.$row2['id_departamento'].'">'.$row2['municipio'].'/'.$row2['cidade'].'-'.$row2['nome'].'</option>';
                            }
                        }
                        echo '</select>';
                    ?>
                </td>
            </tr>
            <tr>
                <th>Responsável:</th>
                <td><input type="text" name="resp" size="100"></td>
            </tr>
            <tr>
                <th>Justificativa:</th>
                <td><textarea name="just" cols="75" rows="10"></textarea></td>
            </tr>
            <tr>
                <th><label for="ent">Entregador: </label></th>
                <td><input type="text" name="entregador" id="ent" size="100"></td>
            </tr>
            <tr>   
                <th><label for="dest">Destinatario:</label></th>
                <td><input type="text" name="destinatario" id="dest" size="100"></td>
            </tr>   
            
        </table>    
        <table border=1>
            <tr>
                <th>Nº Patrimônio</th>
                <th>especificação</th>
                <th>Acessórios</th>
            </tr>
            <tr>
                <td><?= $row['numero_tombo'] ?></td>
                <td><?= $row['especificacao'] ?></td>
                <td><?= $row['acessorio'] ?></td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Movimentar">
    </form>
</body>
</html>