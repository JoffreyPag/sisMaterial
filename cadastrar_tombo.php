<?php
    include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar material</title>
    <style>
        #cabecalho {
            position: fixed;
            top: 0;
            width: 100%;
            background: teal;
            height: 20px;
        }
        #tabela-registro {
            padding-top: 30px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="cabecalho">
    </div >
    <div id="tabela-registro">
        <form action="controle/processo_tombo.php" method="POST">
            <table>
                <tr>
                    <th>
                        <label for="ntombo">Numero de Tombo:</label>
                    </th>
                    <td>
                        <input type="text" name="ntombo" id="ntombo" required/>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="nserie">Numero de Serie:</label>
                    </th>
                    <td>
                        <input type="text" name="nserie" id="nserie" required/>
                    </td>
                </tr>
                <!-- Material -->
                <tr>
                    <th>
                        <label>Material: </label>
                    </th>
                    <td>
                        <select name="material"> 
                            <?php 
                                $sql1 = "SELECT id_material, especificacao FROM etec_materiais WHERE isConsumo = 0";
                                $result1 = $conn->query($sql1);
                                while($row1 = mysqli_fetch_array($result1)){
                                    echo '<option value="'.$row1['id_material'].'">'.$row1['especificacao'].'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="localizacao">Localização Atual:</label>
                    </th>
                    <td>
                        <select name="local">
                            <?php
                                $sql = "SELECT d.id_departamento, d.nome, p.cidade FROM etec_departamento d INNER JOIN etec_polo p ON d.idpolo = p.idpolo";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo ' <option value="'.$row['id_departamento'].'">'.$row['cidade'].' - '.$row['nome'].'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Cadastrar" name="Cadastrar">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>