<?php
include_once("../conexao.php");
if(isset($_POST['Excluir'])){
    $excludeID = $_POST['Excluir'];
    $sql = "DELETE FROM etec_tombo WHERE numero_tombo = '$excludeID'";
}else{
    $nTombo = $_POST["ntombo"];
    $nSerie = $_POST["nserie"];
    $localAtual = $_POST["local"];
    $identificaoMAterial = $_POST["material"];

    if(isset($_POST['Atualizar'])){
        $idTomboAntigo = $_POST['Atualizar'];
        $sql = "UPDATE etec_tombo SET numero_tombo = '$nTombo',numero_serie = '$nSerie', id_material = '$identificaoMAterial' WHERE numero_tombo = '$idTomboAntigo' ";
    }elseif(isset($_POST['Cadastrar'])){
        $sql = "INSERT INTO etec_tombo(numero_tombo, numero_serie, id_departamento, id_material) VALUES('$nTombo','$nSerie', '$localAtual', '$identificaoMAterial')";
    }
}
    echo $sql;
    $result = $conn->query($sql);

    if($result){
        //echo 'sucesso';
        header("Location: ../index.php");
    }else{
        echo 'falha';
    }

?>