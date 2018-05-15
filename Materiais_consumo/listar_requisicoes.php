<?php
include_once("../conexao.php");
$sql = "SELECT rc.id_requisicao, rc.solicitante, rc.dia, rc.mes, rc.ano, rc.stats, po.municipio, po.cidade FROM etec_requisicao_consumo rc 
        INNER JOIN etec_departamento dp ON dp.id_departamento = rc.id_destino 
        INNER JOIN etec_polo po ON po.idpolo = dp.idpolo".(isset($_POST['filtro'])? " WHERE rc.stats = '".$_POST['filtro']."'": "");
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de requisições</title>
</head>
<body>
    <form action="listar_requisicoes.php" method="POST">
        <select name="filtro">
            <option value="ENTREGUE">ENTREGUE</option>
            <option value="ESPERANDO">ESPERANDO</option>      
        </select>
        <input type="submit" value="Pesquisar">
    </form>
    <table border =1>
        <?php
            if($result->num_rows > 0){
                echo '<tr>
                        <th>Status</th>
                        <th>Para</th>
                        <th>Solicitado por:</th>
                        <th>Data</th>
                    </tr>';
                while($row = mysqli_fetch_array($result)){
                    
                    echo '<tr>
                            <td>'.$row['stats'].'</td>
                            <td>'.$row['municipio'].'/'.$row['cidade'].'</td>
                            <td>'.$row['solicitante'].'</td>
                            <td>'.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'</td>
                            <td>
                                <form action="requisicao.php" method="post"><input type="hidden" name="id" value="'.$row['id_requisicao'].'">
                                <input type="submit" value="Ver mais"></form>
                            </td>
                        </tr>';
                    
                }
            }else{
                echo '<h1>Nada encontrado</h1>';
            }
        ?>
    </table>
</body>
</html>