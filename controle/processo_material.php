<?php
include_once("../conexao.php");
$nTombo = $_POST["ntombo"];
$nSerie = $_POST["nserie"];
$especificacao = $_POST["espec"];
$acessorios = $_POST["Acessorios"];
$localAtual = $_POST["local"];

if(isset($_POST['Atualizar'])){
    $idTomboAntigo = $_POST['Atualizar'];
    $sql = "UPDATE etec_materiais SET id_tombo = '$nTombo',numero_serie = '$nSerie', especificacao = '$especificacao', acessorio = '$acessorios', id_polo = '$localAtual' WHERE id_tombo = '$idTomboAntigo' ";
}elseif(isset($_POST['Cadastrar'])){
    $sql = "INSERT INTO etec_materiais(numero_tombo, numero_serie, especificacao, acessorio, id_polo) VALUES('$nTombo','$nSerie', '$especificacao','$acessorios', '$localAtual')";
}elseif(isset($_POST['Excluir'])){
    $excludeID = $_POST['Excluir'];
    $sql = "DELETE FROM etec_materiais WHERE id_tombo = '$excludeID'";
}
    $result = $conn->query($sql);

    if($result){
        //echo 'sucesso';
        header("Location: ../lista-registros.php");
    }else{
        echo 'falha';
    }

?>