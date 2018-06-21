<?php
include_once("../conexao.php");

$sql = "SELECT d.nome, d.id_departamento, p.municipio, p.cidade FROM etec_departamento d 
        INNER JOIN adm_mand_polo p ON d.idpolo = p.idpolo
        WHERE isestoque = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoques ETEC</title>
</head>
<body>
<a href="NovoEstoque.php"><input type="button" value="Criar Novo"></a><br>
    <?php
        while($row = mysqli_fetch_array($result)){
            echo '<div>
                    <p>'.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'</p>
                    <form action="Listar.php" method="post">
                        <button type="submit" value="'.$row['id_departamento'].'" name="Ver">Ver</button>
                    </form>
                    <form action="" method="post">
                        <button type="submit" value="'.$row['id_departamento'].'" name="Editar">Editar</button>
                    </form>
                    <form action="" method="post">
                        <button type="submit" value="'.$row['id_departamento'].'" name="Excluir">Excluir</button>
                    </form>
                </div>';
        }
    ?>
    
</body>
</html>