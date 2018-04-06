<?php
include_once("conexao.php");
$id_material = $_POST['escolhido'];
$sql = "SELECT id_material, isConsumo, especificacao, acessorio FROM etec_materiais WHERE id_material = $id_material";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
if($row['isConsumo']){
    echo 'oi';
}else{
    //procura tombos
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Guia</title>
</head>
<body>
    
</body>
</html>