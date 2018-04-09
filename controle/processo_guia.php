<?php
include_once("../conexao.php");


$so = $_POST['setorOrigem'];
$sd = $_POST['setorDestino'];
$resp = $_POST['responsavel'];
$just = $_POST['justificativa'];
if(isset($_POST['qtd'])){
    $qtd = $_POST['qtd'];
}else{
    $qtd = null;
}
$idMaterial = $_POST['idMaterial'];

if (isset($_POST['nTombo'])){
    $nTombo = $_POST['nTombo'];
    $sql = "INSERT INTO etec_guias (id_origem,  id_destino, id_material, responsavel, justificativa, numero_tombo, quantidade, dia, mes, ano, stats) 
            VALUES('$so', '$sd', '$idMaterial' ,'$resp', '$just', '$nTombo', '$qtd', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
}else{
    $nTombo = "null";
    $sql = "INSERT INTO etec_guias (id_origem,  id_destino, id_material, responsavel, justificativa, quantidade, dia, mes, ano, stats) 
        VALUES('$so', '$sd', '$idMaterial' ,'$resp', '$just', '$qtd', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
}

$result = $conn->query($sql);
echo $sql;

if($result){
    header("Location: ../Guia_transito/guias_transito.php");
}else{
    echo 'error';
}
?>