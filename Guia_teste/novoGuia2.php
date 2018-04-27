<?php
include_once("../conexao.php");
$materials = $_POST['materiais'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Guia - Selecionar tombo</title>
</head>
<body>
    <form action="novoGuia3.php" method="post">
        <?php 
            foreach ($materials as $mat) {
                $dtl = explode(':', $mat);

                echo '<table border=1>
                        <tr>
                            <td colspan=2>'.$dtl[1].'</td>
                        </tr>';
                $sql = "SELECT t.numero_tombo FROM etec_tombo t 
                        INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
                        INNER JOIN etec_materiais_permanentes p ON p.id_permanente = ".$dtl[0]."
                        WHERE d.isestoque = true AND t.id_material = p.id_permanente";
                
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                                <td><input type="checkbox" name="nTombos[]" value="'.$row['numero_tombo'].'"></td>
                                <td>'.$row['numero_tombo'].'</td>
                            </tr>';
                    }
                }else{
                    echo '<tr>
                            <td><p>Indisponivel</h4></p>
                        </tr>';
                }
                echo '</table><br/>';
            }
        ?>
        <input type="submit" value="Continuar">
    </form>
</body>
</html>