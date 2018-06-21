<?php
include_once("../conexao.php");
$guiaID  = $_POST['guia'];

$sql = "SELECT pd.municipio, pd.cidade, dd.nome, dor.nome, 
                g.responsavel, g.justificativa, g.entregador, g.destinatario, 
                g.dia, g.mes, g.ano, g.stats, g.id_tombos 
        FROM etec_guias_lab g 
        LEFT OUTER JOIN etec_departamento dor ON g.id_origem = dor.id_departamento 
        LEFT OUTER JOIN etec_departamento dd ON g.id_destino = dd.id_departamento 
        LEFT OUTER JOIN adm_mand_polo pd ON dd.idpolo = pd.idpolo 
        WHERE g.id_guia = $guiaID";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$sql = "SELECT * FROM numero_tombos WHERE id_tombos = ".$row['id_tombos'];
$resultombos = $conn->query($sql);
$rowtombos = mysqli_fetch_array($resultombos);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guia</title>
</head>
<body>
    <a href="guias_transito.php">Voltar</a>
    <form action="../PDF/gerarguia.php" method="post">
        <input type="hidden" name="tombos" value="<?=$row['id_tombos']?>">
        <input type="hidden" name="idguia" value="<?=$guiaID?>">
        <input type="submit" value="Gerar Documento PDF">
    </form>
    <table border=1>
        <tr>
            <th>Status</th>
            <th>Origem</th>
            <th>Destino</th>
            <th>Justificativa</th>
            <th>Responsavel</th>
            <th>Entregador</th>
            <th>Destinatário</th>
            <th>Data</th>
        </tr>
        <?php
            echo '<tr>
                    <td>'.$row['stats'].'</td>
                    <td>'.$row[3].'</td>
                    <td>'.$row[0].'/'.$row[1].'-'.$row[2].'</td>
                    <td>'.$row['justificativa'].'</td>
                    <td>'.$row['responsavel'].'</td>
                    <td>'.$row['entregador'].'</td>
                    <td>'.$row['destinatario'].'</td>
                    <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                </tr>';
        ?>
    </table>
    <br>
    <table border = 1>
        <tr>
            <th>Numero(s) de tombo(s)</th>
            <th>Material</th>
        </tr>
        <tr>
            <?php
                echo '<td>
                        <ul>';
                for($i=1; $i <= 20; $i++){
                    if($rowtombos[$i] != null){
                        //numeros de tombos
                        echo '<li>'.$rowtombos[$i].'</li>';
                    }else{
                        break;
                    }
                }
                echo '</ul>
                    </td>
                    <td>
                        <ul>';
                //materiais
                for($j=1;$j<=20;$j++){
                    if($rowtombos[$j] != null){
                        $sqltombo = "SELECT m.especificacao FROM etec_tombo t
                                    INNER JOIN etec_materiais_permanentes m ON m.id_permanente = t.id_material
                                    WHERE t.numero_tombo = ".$rowtombos[$j];
                        $resultombo = $conn->query($sqltombo);            
                        $rowtombo = mysqli_fetch_array($resultombo);
                        echo   '<li>'.$rowtombo['especificacao'].'</li>';
                    }else{
                        break;
                    }
                }
                echo '</ul>
                    </td>';
            ?>
        </tr>
    </table>
    <br>
    <table>
    <tr>
        <th>
            <?php 
                if($row['stats'] != "ENTREGUE"){
                    echo '<form action="editar_guia.php" method="POST">
                            <input type="hidden" name="idGuia" value="'.$guiaID.'">
                            <input type="submit" value="Editar" value="Editar">
                        </form>';
                }            
            ?>
            
        </th>
        <th>
            <form action="../controle/processoGuia.php" method="POST">
                <input type="hidden" name="tombos" value="<?=$row['id_tombos']?>">
                <input type="hidden" name="idguia" value="<?=$guiaID?>">
                <input type="submit" name="Excluir" value="Excluir">
            </form>
        </th>
    </tr>
</table>
</body>
</html>