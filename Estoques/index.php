<?php
include_once("../conexao.php");

$sql = "SELECT d.nome, d.id_departamento, p.municipio, p.cidade FROM etec_departamento d 
        INNER JOIN etec_polo p ON d.idpolo = p.idpolo
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
                    <form action="" method="post">
                        <button type="submit" value="IDAQUI" name="Ver">Ver</button>
                    </form>
                    <form action="" method="post">
                        <button type="submit" value="IDAQUI" name="Editar">Editar</button>
                    </form>
                    <form action="" method="post">
                        <button type="submit" value="IDAQUI" name="Excluir">Excluir</button>
                    </form>
                </div>';
        }
    ?>
    
</body>
</html>