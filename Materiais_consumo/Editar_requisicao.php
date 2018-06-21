<?php
include_once("../conexao.php");
$requisicao = $_POST['idreq'];
$tabela = $_POST['idtabela'];
$sqlRequisicao = "SELECT r.solicitante, r.autorizado, r.receptor, r.dia, r.mes, r.ano, r.stats, p.municipio, p.cidade FROM etec_requisicao_consumo r 
                INNER JOIN etec_departamento dp ON r.id_destino = dp.id_departamento 
                INNER JOIN adm_mand_polo p ON dp.idpolo = p.idpolo 
                WHERE r.id_requisicao = $requisicao";

$sqlConsumos = "SELECT * FROM tabela_consumos WHERE id_consumos = $tabela";
$resultRequisicao = $conn->query($sqlRequisicao);
$rowRequisicao = mysqli_fetch_array($resultRequisicao);
$resultConsumos = $conn->query($sqlConsumos);
$rowConsumos = mysqli_fetch_array($resultConsumos);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
</head>
<body>
    <a href="listar_requisicoes.php">Cancelar</a>
    <form action="../controle/processoConsumo.php" method="post">
        <input type="hidden" name="idreq" value="<?= $requisicao?>">
        <table border=1>
            <tr>
                <th>Unidade requisitante:</th>
                <td></td>
                <th>Data:</th>
                <td><?= $rowRequisicao['dia'].'/'.$rowRequisicao['mes'].'/'.$rowRequisicao['ano']?></td>
            </tr>
            <tr><th rowspan=2>Nº ordem</th><th colspan=3>Material</th></tr>
            <tr><th>Descrição</th><th>Unidade</th><th>Quantidade</th></tr>
            <?php
                $indice=1;
                for($i=1; $i<=20; $i+=2){
                    if($rowConsumos[$i] != null){
                        $sqlzinho = "SELECT id_consumo, especificacao, unidade FROM etec_materiais_consumo 
                                    WHERE id_consumo = ".$rowConsumos[$i];
                        $res = $conn->query($sqlzinho);
                        $rowzinho = mysqli_fetch_array($res);
                        echo '<tr>
                            <td>'.$indice.'</td>
                            <td>'.$rowzinho['especificacao'].'<input type="hidden" name="ids[]" value="'.$rowzinho['id_consumo'].'"></td>
                            <td>'.$rowzinho['unidade'].'</td>
                            <td>'.$rowConsumos[$i+1].'<input type="hidden" name="qtds[]" value="'.$rowConsumos[$i+1].'"></td>
                        </tr>';
                        $indice++;
                    }else{break;}
                }
            ?>
            <tr>
                <th><label for="sol">Solicitado por:</label></th>
                <th><label for="aut">Autorizado por:</label></th>
                <th colspan=2><label for="rec">Recebido por:</label></th>
            </tr>
            <tr>
                <td><input type="text" name="solicitante" value="<?= $rowRequisicao['solicitante']?>" id="sol" required></td>
                <td><input type="text" name="autorizado" value="<?= $rowRequisicao['autorizado']?>" id="aut" required></td>
                <td><input type="text" name="receptor" value="<?= $rowRequisicao['receptor']?>" id="rec" required></td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td>
                    <select name="estado">
                        <option value="ESPERANDO">ESPERANDO</option>
                        <option value="ENTREGUE">ENTREGUE</option>      
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="Atualizar" name="Atualizar">
    </form>
</body>
</html>