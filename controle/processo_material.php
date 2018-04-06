<?php
include_once("../conexao.php");
if(isset($_POST['Excluir'])){
    $id = $_POST['Excluir'];
    $sql = "DELETE FROM etec_materiais WHERE id_material = '$id'";

}else{
    $espec = $_POST["Especificacao"];
    $acess = $_POST["Acessorios"];
    $qtd = $_POST['quantidade'];
    if(isset($_POST['Cadastrar'])){
        $econsumo = ($_POST['tipoMaterial'] == "consumo")? true : false;
        $sql = "INSERT INTO etec_materiais(especificacao, acessorio, isconsumo, quantidade) VALUES('$espec','$acess', '$econsumo', '$qtd')";
    }elseif(isset($_POST['Atualizar'])){
        $id = $_POST['Atualizar'];
        $sql = "UPDATE etec_materiais 
                SET especificacao = '$espec', acessorio = '$acess', quantidade = '$qtd' WHERE id_material = '$id'";
    }
}

$result = $conn->query($sql);

    if($result){
        //echo 'sucesso';
        header("Location: ../index.php");
    }else{
        echo 'falha';
    }
?>