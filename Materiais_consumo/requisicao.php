<?php
include_once("../conexao.php");
$id = $_POST['id'];
$sql = "SELECT rc.id_requisicao, rc.id_consumos, rc.solicitante, rc.autorizado, rc.receptor, rc.dia, rc.mes, rc.ano, rc.stats, 
                dp.nome, po.municipio, po.cidade 
        FROM etec_requisicao_consumo rc 
        INNER JOIN etec_departamento dp ON rc.id_destino = dp.id_departamento 
        INNER JOIN etec_polo po ON po.idpolo = dp.idpolo 
        WHERE id_requisicao = $id";
$result = $conn->query($sql);

$row = mysqli_fetch_array($result);
$sqlconsumos = "SELECT * FROM tabela_consumos WHERE id_consumos = ".$row['id_consumos'];
$result2 = $conn->query($sqlconsumos);
$rowconsumos = mysqli_fetch_array($result2);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requisição</title>
</head>
<body>
    <table border=1>
        <tr><th colspan=4>Material Requisitado</th></tr>
        <tr>
            <th>Unidade requisitante:</th>
            <td><?php echo $row['municipio'].'/'.$row['cidade'].'-'.$row['nome'];?></td>
            <th>Data:</th><td><?php echo $row['dia'].'/'.$row['mes'].'/'.$row['ano'];?></td>    
        </tr>
        <tr><th rowspan=2>Nº ordem</th><th colspan=3>Material</th></tr>
        <tr><th>Descrição</th><th>Unidade</th><th>Quantidade</th></tr>
        <?php
            $indice=1;
            for($i=1; $i<=20; $i+=2){
                if($rowconsumos[$i] != null){
                    $sqlzinho = "SELECT especificacao, unidade FROM etec_materiais_consumo 
                                WHERE id_consumo = ".$rowconsumos[$i];
                    $res = $conn->query($sqlzinho);
                    $rowzinho = mysqli_fetch_array($res);
                    echo '<tr>
                        <td>'.$indice.'</td>
                        <td>'.$rowzinho['especificacao'].'</td>
                        <td>'.$rowzinho['unidade'].'</td>
                        <td>'.$rowconsumos[$i+1].'</td>
                    </tr>';
                    $indice++;
                }else{break;}
            }
        ?>
    </table>
    <br>
    <form action=""><input type="submit" value="Editar"></form>
    <form action=""><input type="submit" value="Excluir"></form>
</body>
</html>