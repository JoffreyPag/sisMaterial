<?php
include_once("../conexao.php");


if(isset($_POST['Cadastrar'])){
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
        $sql = "INSERT INTO etec_guias (id_origem,  id_destino, id_material, responsavel, isConsumo ,justificativa, numero_tombo, dia, mes, ano, stats) 
                VALUES('$so', '$sd', '$idMaterial' ,'$resp', false,'$just', '$nTombo', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
    }else{
        $nTombo = "null";
        $sql = "INSERT INTO etec_guias (id_origem,  id_destino, id_material, isConsumo, responsavel, justificativa, quantidade, dia, mes, ano, stats) 
            VALUES('$so', '$sd', '$idMaterial', true ,'$resp', '$just', '$qtd', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
    }
}elseif(isset($_POST['Excluir'])){
    $id = $_POST['idguia'];
    $sql = "DELETE FROM etec_guias WHERE id_guia = '$id'";
}elseif(isset($_POST['Atualizar'])){
    $id = $_POST['Atualizar'];
    $estd = $_POST['estado'];
    $qtd = $_POST['qtd'];
    $tipo = $_POST['tipo'];
    $idm = $_POST['id'];
    $entregador = $_POST['entregador'];
    $dest = $_POST['destinatario'];

    if ($tipo=="consumo") {
        $atConsumo = "UPDATE etec_materiais_consumo SET quantidade = quantidade - $qtd WHERE id_consumo = $idm";
        $tempquery = $conn->query($atConsumo);
    }else{
        $nTombo = $_POST['ntombo'];
        $iddp = $_POST['departamento'];
        $atPermanente = "UPDATE etec_tombo SET id_departamento = $iddp WHERE numero_tombo = $nTombo";
        $tempquery = $conn->query($atPermanente);
    }
    $sql = "UPDATE etec_guias 
            SET stats = '$estd', destinatario = '$dest', entregador = '$entregador' WHERE id_guia = '$id'";
}
//NOT IN USE YET
elseif(isset($_POST['Movimentar'])){
    $dpOr = $_POST['setorOrigem'];
    $dpDs = $_POST['setorDestino'];
    $resp = $_POST['resp'];
    $just = $_POST['just'];
    $ntombo = $_POST['ntombo'];
    $idMaterial = $_POST['idMaterial'];
    $sql = "INSERT INTO etec_guias(id_origem,  id_destino, id_material, responsavel, isConsumo, justificativa, numero_tombo, dia, mes, ano, stats) 
    VALUES('$dpOr', '$dpDs', '$idMaterial' ,'$resp', false,'$just', '$ntombo', day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
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