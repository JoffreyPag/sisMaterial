<?php
include_once("../conexao.php");
//setorDestino, ids[], qtds[], solicitado, autorizado, recebido
if(isset($_POST['Solicitar'])){

    $idsCosumo = $_POST['ids'];
    $quats = $_POST['qtds'];
    $destino = $_POST['setorDestino'];
    $solicitante = $_POST['solicitado'];
    $autorizador = $_POST['autorizado'];
    $recebido = $_POST['recebido'];

    //primeiro salva as id de materiais de consumo
    $colunas = "";
    $valores = "";
    for($i=0; $i<count($idsCosumo); $i++){
        $colunas.="c".($i+1).", qtd".($i+1);
        $valores.=$idsCosumo[$i].", ".$quats[$i];
        if(($i+1) < count($idsCosumo)){
            $colunas.=", ";
            $valores.=", ";
        }
    }

    $sqlidsconsumo = "INSERT INTO tabela_consumos(".$colunas.") VALUES(".$valores.")";
    $result = $conn->query($sqlidsconsumo);
    //$result = false;
    if($result){
        $id = mysqli_insert_id($conn);
        $sql = "INSERT INTO etec_requisicao_consumo(id_consumos, id_destino, solicitante,
                                                    autorizado, receptor, dia, mes, ano, stats)
                VALUES ($id, '$destino', '$solicitante', '$autorizador', '$recebido', day(CURRENT_DATE), 
                        month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";

        $salvar = $conn->query($sql);
        //echo $sql;
        redirecionar($salvar);
    }else{
        //echo $sqlidsconsumo;
    }
}
else if(isset($_POST['Atualizar'])){

}else if(isset($_POST['Excluir'])){
    
}else{

}

function redirecionar($bol){
    if($bol){
        header("Location: ../");
    }else{
        //echo 'error';
        header("Location: ../ErroAdvice.html");
    }
}
?>