<?php
include_once("conexao.php");
$sqlSetor = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d
            INNER JOIN etec_polo p ON d.idpolo = p.idpolo";
$resultOrigem = $conn->query($sqlSetor);
$resultDestino = $conn->query($sqlSetor);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo guia</title>
</head>
<body>
    <table>
        <tr>
            <th>Setor de origem:</th>
            <td>
                <select name="setorOrigem">
                    <?php 
                        while($row = mysqli_fetch_array($resultOrigem)){
                            echo '<option value="id_departamento">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
                        }
                    ?>      
                </select>
            </td>
        </tr>
        <tr>
            <th>Setor de destino:</th>
            <td>
                <select name="setorDestino">
                    <?php 
                        while($row = mysqli_fetch_array($resultDestino)){
                            echo '<option value="id_departamento">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
                        }
                    ?>      
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="resp">Responsável:</label></th>
            <td><input type="text" name="responsavel" id="resp"></td>
        </tr>
        <tr>
            <th><label for="just">Justificativa:</label></th>
            <td><textarea name="justificativa" id="just" cols="100" rows="10" value=" - "></textarea></td>
        </tr>
        <tr>
            <th>Numero do patrimônio:</th>
            <th>Quantidade: </th>
            <th>Es</th>
        </tr>
    </table>
</body>
</html>