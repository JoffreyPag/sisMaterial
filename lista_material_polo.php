<?php
include_once("conexao.php");
    $poloID = $_POST["polo"];

    if(isset($_POST['departamento'])){
        $dpID = $_POST['departamento'];
        $sqlpolo = "SELECT t.numero_tombo, t.numero_serie, t.id_material, m.especificacao, d.id_departamento, d.nome, p.cidade FROM etec_tombo t 
        INNER JOIN etec_materiais_permanentes m ON t.id_material = m.id_permanente
        INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
        INNER JOIN etec_polo p ON d.idpolo = p.idpolo
        WHERE d.id_departamento = $dpID";
        
    }else{
        $sqlpolo = "SELECT t.numero_tombo, t.numero_serie, t.id_material, m.especificacao, d.id_departamento, d.nome, p.cidade FROM etec_tombo t 
        INNER JOIN etec_materiais_permanentes m ON t.id_material = m.id_permanente
        INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
        INNER JOIN etec_polo p ON d.idpolo = p.idpolo
        WHERE p.idpolo = $poloID";
        
    }
    $resultadopolo = $conn->query($sqlpolo);
    
    $infopolo = "SELECT municipio, cidade FROM etec_polo where idpolo = $poloID";
    $res = $conn->query($infopolo);
    $polon = mysqli_fetch_array($res);

    $sqlpolos = "SELECT idpolo, municipio, cidade FROM etec_polo"; 
    $resultadolista = $conn->query($sqlpolos);

    $sqlSetor = "SELECT id_departamento, nome FROM etec_departamento WHERE idpolo = $poloID";
    $resSetor = $conn->query($sqlSetor);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materiais por polo</title>
</head>
<body>
    <h1><?php echo $polon['municipio'].' - '.$polon['cidade']; ?></h1>
    <a href="index.php">Voltar</a>
    <form action="lista_material_polo.php" method="POST">
        <select name="polo" id="">
            <?php
                while($row = mysqli_fetch_array($resultadolista)){
                    echo '<option value="'.$row['idpolo'].'">'.$row['municipio'].' - '.$row['cidade'].'</option>';
                }
            ?>
        </select>        
        <input type="submit" value="Pesquisar">
    </form>
    <form action="lista_material_polo.php" method="post">
        <select name="departamento" id="">
            <?php
                while($row = mysqli_fetch_array($resSetor)){
                    echo '<option value="'.$row['id_departamento'].'">'.$row['nome'].'</option>';
                }
            ?>
        </select>
        <input type="hidden" name="polo" value="<?=$poloID?>">
        <input type="submit" value="Pesquisar">
    </form>
    <?php
    if($resultadopolo->num_rows > 0){
        echo '
        <table border="1">
        <tr>
            <th>Numero Tombo</th>
            <th>Numero Serie</th>
            <th>Especificacao</th>
            <th>Setor</th>
        </tr>';
        while($row = mysqli_fetch_array($resultadopolo)){
            echo '<tr>
            <td>'.$row['numero_tombo'].'</td>
            <td>'.$row['numero_serie'].'</td>
            <td>'.$row['especificacao'].'</td>
            <td>'.$row['nome'].'</td></tr>';
        }
        echo'</table>';
    }else{
        echo '<h4>NADA ENCONTRADO NESSE POLO</h4>';
    }

    ?>
    
</body>
</html>