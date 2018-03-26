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
        <form action="controle/processo_material.php" method="POST">
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
                <tr>
                    <th>
                        <label for="espec">Especificação:</label>
                    </th>
                    <td>
                        <input type="text" name="espec" id="espec" required/>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="acess">Acessórios:</label>
                    </th>
                    <!--ficar de olho nisso-->
                    <td>
                        <input type="text" name="Acessorios" id="acess" required>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="localizacao">Localização Atual:</label>
                    </th>
                    <td>
                        <select name="local">
                            <?php
                                $sql = "SELECT idpolo, cidade FROM etec_polo";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_array($result)){
                                    echo ' <option value="'.$row['idpolo'].'">'.$row['cidade'].'</option>';
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