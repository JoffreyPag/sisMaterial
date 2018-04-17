<?php
include_once("../conexao.php");
$sqlSetorD = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d
            INNER JOIN etec_polo p ON d.idpolo = p.idpolo";
$resultDestino = $conn->query($sqlSetorD);
if(isset($_POST['numeroTombo'])){
    $ntombo = $_POST['numeroTombo'];
    $sql = "SELECT m.especificacao, m.acessorio, m.id_permanente FROM etec_materiais_permanentes m
            INNER JOIN etec_tombo t ON m.id_permanente = t.id_material
            WHERE t.numero_tombo = $ntombo";   
}elseif(isset($_POST['escolhido'])){
    $id = $_POST['escolhido'];
    $iddp = $_POST['dp'];
    $sql = "SELECT especificacao, id_consumo, quantidade FROM etec_materiais_consumo WHERE id_consumo = $id";
    $sqlSetorO = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d
            INNER JOIN etec_polo p ON d.idpolo = p.idpolo
            WHERE id_departamento = $iddp";
    $resultOrigem = $conn->query($sqlSetorO);
}

//echo $row['especificacao']
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo guia</title>
</head>
<body>

    <form action="../controle/processo_guia.php" method="POST">
        <?php 
            if(isset($_POST['numeroTombo'])){
                echo '<input type="hidden" name="nTombo" value='.$ntombo.'>';
            } 
        ?>
        <table border=1>
            <tr>
                <th>Setor de origem:</th>
                <td>
                    <select name="setorOrigem">
                        <?php 
                            while($row = mysqli_fetch_array($resultOrigem)){
                                echo '<option value="'.$row['id_departamento'].'">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
                            }
                        ?>      
                    </select>
                </td>
            </tr>
            <tr>
                <th>Setor de destino:</th>
                <td>
                    <select name="setorDestino">
                        <?php 
                            while($row = mysqli_fetch_array($resultDestino)){
                                echo '<option value="'.$row['id_departamento'].'">'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</option>';
                            }
                        ?>      
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="resp">Responsável:</label></th>
                <td><input type="text" name="responsavel" id="resp"></td>
            </tr>
            <tr>
                <th><label for="just">Justificativa:</label></th>
                <td><textarea name="justificativa" id="just" cols="70" rows="10"></textarea></td>
            </tr>
        </table>
        <table border=1>
            <tr>
                <th>Nº patrimônio</th>
                <th>Quantidade</th>
                <th>Especificação</th>
                <th>Acessórios</th>
            </tr>
            <tr>
                <td><?php 
                if(isset($_POST['numeroTombo'])){
                    echo $ntombo;
                }else{
                    '';
                }
                ?>
                </td>
                <td><?php
                    if(!isset($_POST['numeroTombo'])){
                        echo '<input type="number" name="qtd" id="" min="1" value="1">' ;   
                    }
                    ?>
                    </td>
                    
                <?php
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_array($result);

                    if(isset($_POST['escolhido'])){
                        echo '<td>'.$row['especificacao'].'<input type="hidden" name="idMaterial" value='.$row['id_consumo'].'></td>
                        <td> </td>';
                    }else{
                        echo '<td>'.$row['especificacao'].'</td>
                            <td>'.$row['acessorio'].'<input type="hidden" name="idMaterial" value='.$row['id_material'].'></td>';
                    }
                ?>
            </tr>
        </table>
        <input type="submit" name="Cadastrar" value="Concluir">
    </form>
    <?php echo '<a href="novoGuiaet1.php">Cancelar</a>'?>
</body>
</html>