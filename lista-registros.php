<?php
    include_once("conexao.php");
    if(isset($_POST['tipo']) && isset($_POST['filtro'])){
        $campo = $_POST['tipo'];
        $valor = $_POST['filtro'];
        $sql = "SELECT m.id_tombo, m.numero_tombo, m.numero_serie, m.especificacao, m.acessorio, p.cidade FROM etec_materiais m INNER JOIN etec_polo p ON m.id_polo = p.idpolo WHERE m.$campo = '$valor'";
    }else{
        $sql = "SELECT m.id_tombo, m.numero_tombo, m.numero_serie, m.especificacao, m.acessorio, p.cidade FROM etec_materiais m INNER JOIN etec_polo p ON m.id_polo = p.idpolo";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materiais</title>
    <link rel="stylesheet" type="text/css" href="CSS/estilos.css"/>
</head>
<body>

    <div>
        <a href="formulario-basico.php"><input type="button" value="Adicionar item"></a>  
        <form action="lista-registros.php" method="POST">
            <select name="tipo" id="">
                <option value="numero_tombo">Numero do Tombo</option>
                <option value="numero_serie">Numero de serie</option>      
            </select>
            <input type="text" name="filtro"/>
            <input type="submit" value="Pesquisar">
        </form>
    </div>
    <div class="tabela">
    <table border="1">
        <tr>
            <th>Numero de tombo</th>
            <th>Numero de serie</th>
            <th>Especificação</th>
            <th>Acessórios</th>
            <th>Localização Atual</th>
        </tr>
        <?php 
            $result = $conn->query($sql);
            while($row = mysqli_fetch_array($result)){
                echo'<tr>
                <td>'.$row['numero_tombo'].'</td>
                <td>'.$row['numero_serie'].'</td>
                <td>'.$row['especificacao'].'</td>
                <td>'.$row['acessorio'].'</td>
                <td>'.$row['cidade'].'</td>
                <td>
                    <form action="editar_material.php" method="POST">
                        <button type="submit" value="'.$row['id_tombo'].'" name="editar">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="controle/processo_material.php" method="POST">
                        <button type="submit" value="'.$row['id_tombo'].'" name="Excluir">Excluir</button>
                    </form>
                </td>
                </tr>';
            }
        ?>
    </table>
    </div>
</body>
</html>