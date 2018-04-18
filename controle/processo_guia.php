<?php
include_once("../conexao.php");


if(isset($_POST['Cadastrar'])){
    //TODO EDITAR AQUI!!
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
}elseif(isset($_POST['Excluir'])){
    $id = $_POST['idguia'];
    $sql = "DELETE FROM etec_guias WHERE id_guia = '$id'";
}elseif(isset($_POST['Atualizar'])){
    $id = $_POST['Atualizar'];
    $estd = $_POST['estado'];
    $sql = "UPDATE etec_guias 
            SET stats = '$estd' WHERE id_guia = '$id'";
}elseif(isset($_POST['Movimentar'])){
    $dpOr = $_POST['idvelha'];
    $dpDs = $_POST['setorDestino'];
    $resp = $_POST['resp'];
    $just = $_POST['just'];
    $ntombo = $_POST['ntombo'];
    $idMaterial = $_POST['idMaterial'];
    $sql = "INSERT INTO etec_guias(id_origem,  id_destino, id_material, responsavel, justificativa, numero_tombo, dia, mes, ano, stats) 
    VALUES('$dpOr', '$dpDs', '$idMaterial' ,'$resp', '$just', '$ntombo', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
}

$result = $conn->query($sql);
echo $sql;

if($result){
    if(isset($_POST['Movimentar'])){
        header("Location: ../tombos.php");
    }else{
        header("Location: ../Guia_transito/guias_transito.php");
    }
}else{
    echo 'error';
}
?>