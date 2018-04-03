<?php
    include_once("conexao.php");
    $idTombo = $_POST["editar"];
    //echo $idMaterial
    $sql = "SELECT t.numero_tombo, t.numero_serie, t.id_material, m.especificacao, d.id_departamento, d.nome, p.idpolo, p.cidade FROM etec_tombo t 
    INNER JOIN etec_materiais m ON t.id_material = m.id_material
    INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
    INNER JOIN etec_polo p ON d.idpolo = p.idpolo
    WHERE t.numero_tombo = $idTombo";

    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar material</title>
</head>
<body>
    <form action="controle/processo_tombo.php" method="POST">
        <table border="1">
            <tr>
                <th>
                    <label for="ntombo">Numero de Tombo:</label>
                </th>
                <td>
                    <input type="text" name="ntombo" id="ntombo" value="<?=$row['numero_tombo'] ?>" required/>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="nserie">Numero de Serie:</label>
                </th>
                <td>
                    <input type="text" name="nserie" id="nserie" value="<?=$row['numero_serie'] ?>" required/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Material: </label>
                </th>
                <td>
                    <select name="material">
                        <option value="<?=$row['id_material']?>"><?=$row['especificacao']?></option>
                        <?php 
                            $sql3 = "SELECT id_material, especificacao FROM etec_materiais";
                            $result3 = $conn->query($sql3);
                            while($row2 = mysqli_fetch_array($result3)){
                                echo ' <option value="'.$row2['id_material'].'">'.$row2['especificacao'].'</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <!--<tr>
                <th>
                    <label for="localizacao">Localização Atual:</label>
                </th>
                <td>
                    <select name="local">
                        <option value="<?=$row['idpolo'] ?>"><?=$row['cidade'] ?></option>
                        <?php
                            $sql2 = "SELECT idpolo, cidade FROM etec_polo";
                            $result2 = $conn->query($sql2);
                            while($row2 = mysqli_fetch_array($result2)){
                                echo ' <option value="'.$row2['idpolo'].'">'.$row2['cidade'].'</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td colspan="2">
                    <button type="submit" value="<?=$row['numero_tombo'] ?>" name="Atualizar">Atualizar</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>