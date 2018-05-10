<?php
include_once("../conexao.php");
$sql = "SELECT d.nome, p.municipio, p.cidade  FROM etec_departamento d 
        INNER JOIN etec_polo p ON d.idpolo = p.idpolo";

$result = $conn->query($sql);
$materials = $_POST['materiais'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento</title>
</head>
<body>
    <form action="" method="post">
        <table border =1>
            <tr>
                <th colspan=7>Requisição Interna de Material</th>
            </tr>
            <tr>
                <th colspan=2>Unidade Requisitante</th>
                <td colspan=2>
                    <select name="setorDestino">
                        <?php
                            while($row = mysqli_fetch_array($result)){
                                echo '<option value="'.$row['id_departamento'].'">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td></td>
                <th>Data:</th>
                <td ><?php echo date('d/m/Y')?></td>
            </tr>
            <tr>
                <th rowspan=2>Nº de ordem</th>
                <th colspan=4>Material</th>
                <th coslpan=2>Quantidade</th>
            </tr>
            <tr>
                <th colspan=3>Descrição</th>
                <th>Unidade*</th>
                <th>Solicitada</th>
                <th>Atendida</th>
            </tr>
                <?php
                    $n=1;
                    foreach ($materials as $mat) {
                        $dtl = explode(':', $mat);
        
                        echo '
                                <tr>
                                    <td>'.$n.'</td>
                                    <td colspan=3>'.$dtl[1].'</td>
                                    <td>
                                        <input type="hidden" name="ids[]" value="'.$dtl[0].'">
                                        <input type="text" name="unidade" required>
                                    </td>
                                    <td>'.$dtl[2].'</td>
                                    <td><input type="number" name="qtd" value="1" min="0" max="'.$dtl[2].'"></td>
                                </tr>';
                        $n++;
                    }
                ?>         
            <tr>
                <th colspan=3><label for="sol">Solicitado por*:</label></th>
                <th colspan=2><label for="aut">Autorizado por*:</label></th>
                <th colspan=2><label for="rec">Recebido por:</label></th>
            </tr>
            <tr>
                <td colspan=3><input type="text" name="solicitado" id="sol" size="45" required></td>
                <td colspan=2><input type="text" name="autorizado" id="aut" size="35" required></td>
                <td colspan=2><input type="text" name="recebido" id="rec" size="35"></td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Confirmar">
    </form>
</body>
</html>