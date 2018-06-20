<?php
include_once("../conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Estoque</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </div>
        <br>
        <div>
            <label for="polo">Polo:</label>
            <select name="local">
                <?php
                    $sql = "SELECT cidade, municipio, idpolo FROM etec_polo";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_array($result)){
                        echo ' <option value="'.$row['idpolo'].'">'.$row['municipio'].' - '.$row['cidade'].'</option>';
                    }
                ?>
            </select>
        </div>
    </form>
</body>
</html>