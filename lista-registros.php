<?php
    include_once("conexao.php");
    if(isset($_POST['tipo']) && isset($_POST['filtro'])){
        $campo = $_POST['tipo'];
        $valor = $_POST['filtro'];
        $sql = "SELECT t.numero_tombo, t.numero_serie, m.especificacao, m.acessorio, d.nome, d.isestoque, p.cidade FROM etec_tombo t 
        INNER JOIN etec_materiais m ON t.id_material = m.id_material 
        INNER JOIN etec_departamento d ON d.id_departamento = t.id_departamento 
        INNER JOIN etec_polo p ON d.id_polo = p.id_polo WHERE t.$campo = '$valor'";

    }else{
        $sql = "SELECT t.numero_tombo, t.numero_serie, m.especificacao, m.acessorio, d.nome, d.isestoque, p.cidade FROM etec_tombo t 
        INNER JOIN etec_materiais m ON t.id_material = m.id_material 
        INNER JOIN etec_departamento d ON d.id_departamento = t.id_departamento 
        INNER JOIN etec_polo p ON d.id_polo = p.id_polo";
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
        <a href="cadastrar_tombo.php"><input type="button" value="Cadastrar Tombo"></a>
        <a href="cadastrar_material.php"><input type="button" value="Adicionar Material"></a>  
        
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
            <Th>Setor</th>
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
                <td>'.$row['nome'].'</td>
                <td>
                    <form action="editar_tombo.php" method="POST">
                        <button type="submit" value="'.$row['numero_tombo'].'" name="editar">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="controle/processo_material.php" method="POST">
                        <button type="submit" value="'.$row['numero_tombo'].'" name="Excluir">Excluir</button>
                    </form>
                </td>
                </tr>';
            }
        ?>
    </table>
    </div>
</body>
</html>