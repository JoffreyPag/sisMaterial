<?php
include_once("../conexao.php");

if(isset($_POST['Cadastrar'])){
    $setorOrigem = $_POST['setorOrigem'];
    $setorDestino = $_POST['setorDestino'];
    $responsavel = $_POST['responsavel'];
    $Justificativa = $_POST['justificativa'];
    $tombos = $_POST['ntombos'];

    $colunas = "";
    $valores = "";
    for($i=0; $i<count($tombos); $i++){
        $colunas.="t".($i+1);
        $valores.=$tombos[$i];
        if(($i+1) < count($tombos)){
            $colunas.=", ";
            $valores.=", ";
        }
    }
    $sql = "INSERT INTO numero_tombos (".$colunas.") VALUES(".$valores.")";
    $result = $conn->query($sql);
    if($result){
        $id = mysqli_insert_id($conn);
        $sql = "INSERT INTO etec_guias_lab (id_tombos, id_origem, id_destino,
                                            responsavel, justificativa,
                                            dia, mes, ano, stats) 
                VALUES('$id', '$setorOrigem', '$setorDestino', '$responsavel',
                        '$Justificativa', day(CURRENT_DATE), month(CURRENT_DATE), 
                        year(CURRENT_DATE), 'ESPERANDO')";
        $result1 = $conn->query($sql);
        redirecionar($result1);
    }else{
        echo $sql;
        echo 'erro cadastrar tombos';
    }

}
else if(isset($_POST['Atualizar'])){

}

else if(isset($_POST['Exluir'])){
    $id = $_POST['idguia'];
    $sql = "DELETE FROM etec_guias WHERE id_guia = '$id'";
    $result1 = $conn->query($sql);
    redirecionar($result1);
}

function redirecionar($bol){
    if($bol){
        header("Location: ../Guia_transito/guias_transito.php");
    }else{
        echo 'error';
    }
}
?>