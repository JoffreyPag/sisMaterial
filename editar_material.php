<?php
    include_once("conexao.php");
    $idMaterial = $_POST["editar"];
    //echo $idMaterial
    $sql = "SELECT m.id_tombo, m.numero_serie, m.especificacao, m.acessorio, p.cidade, m.id_polo FROM etec_materiais m INNER JOIN etec_polo p ON m.id_polo = p.idpolo WHERE m.id_tombo = $idMaterial";
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
    <form action="controle/processo_material.php" method="POST">
        <table>
            <tr>
                <th>
                    <label for="ntombo">Numero de Tombo:</label>
                </th>
                <td>
                    <input type="text" name="ntombo" id="ntombo" value="<?=$row['id_tombo'] ?>" required/>
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
                    <label for="espec">Especificação:</label>
                </th>
                <td>
                    <input type="text" name="espec" id="espec" value="<?=$row['especificacao'] ?>" required/>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="acess">Acessórios:</label>
                </th>
                <!--ficar de olho nisso-->
                <td>
                    <input type="text" name="Acessorios" id="acess" value="<?=$row['acessorio'] ?>" required>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="localizacao">Localização Atual:</label>
                </th>
                <td>
                    <select name="local">
                        <option value="<?=$row['id_polo'] ?>"><?=$row['cidade'] ?></option>
                        <?php
                            $sql2 = "SELECT idpolo, cidade FROM etec_polo";
                            $result2 = $conn->query($sql2);
                            while($row2 = mysqli_fetch_array($result2)){
                                echo ' <option value="'.$row2['idpolo'].'">'.$row2['cidade'].'</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" value="<?=$row['id_tombo'] ?>" name="Atualizar">Atualizar</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>