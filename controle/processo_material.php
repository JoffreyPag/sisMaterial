<?php
include_once("../conexao.php");

$espec = $_POST["Especificacao"];
$acess = $_POST["Acessorios"];

if(isset($_POST['Cadastrar'])){
    $sql = "INSERT INTO etec_materiais(especificacao, acessorio) VALUES('$epsec','$acess')";
}elseif(isset($_POST['Atualizar'])){
    //$sql = "UPDATE etec_materiais SET id_tombo = '$nTombo',numero_serie = '$nSerie', especificacao = '$especificacao', acessorio = '$acessorios', id_polo = '$localAtual' WHERE id_tombo = '$idTomboAntigo' ";
}

$result = $conn->query($sql);

    if($result){
        //echo 'sucesso';
        header("Location: ../lista-registros.php");
    }else{
        echo 'falha';
    }
?>