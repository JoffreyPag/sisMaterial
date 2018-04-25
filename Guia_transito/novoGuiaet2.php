<?php
include_once("../conexao.php");
$id_material = $_POST['escolhido'];
$sql = "SELECT t.numero_tombo, t.numero_serie, t.id_departamento ,d.nome, m.especificacao, m.acessorio FROM etec_tombo t
        INNER JOIN etec_departamento d ON d.id_departamento = t.id_departamento
        INNER JOIN etec_materiais_permanentes m ON m.id_permanente = t.id_material
        WHERE t.id_material = $id_material AND d.isestoque = 1";
$result = $conn->query($sql);
//$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Guia</title>
</head>
<body>                          
                        
<h4>Tombos encontrados disponiveis</h4>
    <?php
        if($result->num_rows > 0){
            echo '<table border=1>
            <tr>
                <th>Numero de tombo</th>
                <th>Numero de serie</th>
                <th>Especificacao</th>
                <th>Estoque</th>
            </tr>';
            while($row = mysqli_fetch_array($result)){
                echo '<tr>
                        <td>'.$row['numero_tombo'].'</td>
                        <td>'.$row['numero_serie'].'</td>
                        <td>'.$row['especificacao'].'</td>
                        <td>'.$row['nome'].'</td>
                        <td><form action="novoGuiaet3.php" method="post">
                            <input type="hidden" name="dp" value="'.$row['id_departamento'].'">
                            <button type="submit" value="'.$row['numero_tombo'].'" name="numeroTombo">Confirmar</button>
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
            
        }else{
            echo '<h4>Nenhum em estoque</h4>';
        }
    ?>
    <input type="submit" value="Confirm">
    </form>
    <a href="novoGuiaet1.php">Voltar</a>
</body>
</html>