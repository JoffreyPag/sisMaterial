<?php
include_once("../conexao.php");
$tombos = $_POST['nTombos'];
$iddp = $_POST['departamento'];
//echo count($tombos);
//foreach ($tombos as $tombo) {;
  //  echo $tombo."<br/>";
//}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo guia - Finalizar pedido</title>
</head>
<body>
    <form action="../controle/processoGuia.php" method="post">
        <table border=1>
            <tr>
                <th>Setor de origem:</th>
                <td>
                    <?php 
                        $setorO = "SELECT p.municipio, p.cidade, d.nome FROM etec_polo p
                                    INNER JOIN etec_departamento d ON d.idpolo = p.idpolo
                                    WHERE d.id_departamento = ".$iddp;
                        $resultSO = $conn->query($setorO);
                        $row = mysqli_fetch_array($resultSO);
                        echo $row['municipio'].'/'.$row['cidade'].'-'.$row['nome'];
                        echo '<input type="hidden" name="setorOrigem" value="'.$iddp.'">';
                    ?>
                </td>
            </tr>
            <tr>
                <th>Setor de destino:</th>
                <td>
                    <select name="setorDestino">
                        <?php
                            $sqlSetorD = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d
                                            INNER JOIN etec_polo p ON d.idpolo = p.idpolo";
                            $resultDestino = $conn->query($sqlSetorD); 
                            while($row = mysqli_fetch_array($resultDestino)){
                                echo '<option value="'.$row['id_departamento'].'">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
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
                <td><textarea name="justificativa" id="just" cols="70" rows="10"></textarea></td>
            </tr>
        </table>
        <table border=1>
            <tr>
                <th>Nº Patrimônio</th>
                <th>Especificação</th>
                <th>Acessórios</th>
            </tr>
            <?php 
                foreach($tombos as $tombo){
                    $sql = "SELECT t.numero_tombo, m.especificacao, m.acessorio FROM etec_tombo t 
                            INNER JOIN etec_materiais_permanentes m ON m.id_permanente = t.id_material
                            WHERE t.numero_tombo = $tombo";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_array($result);
                    echo '<tr>
                            <td>'.$row['numero_tombo'].'<input type="hidden" name="ntombos[]" value="'.$row['numero_tombo'].'"></td>
                            <td>'.$row['especificacao'].'<input type="hidden" name="especificacoes[]" value="'.$row['especificacao'].'"></td>
                            <td>'.$row['acessorio'].'<input type="hidden" name="acessorios[]" value="'.$row['acessorio'].'"></td>
                        </tr>';
                }
            ?>  
        </table>
        <input type="submit" value="Cadastrar" name="Cadastrar">
    </form>
</body>
</html>