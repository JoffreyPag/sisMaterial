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
    $estado = $_POST['estado'];
    $entregador = $_POST['entregador'];
    $destinatario = $_POST['destinatario'];
    $id = $_POST['Atualizar'];

    $sql = "UPDATE etec_guias_lab 
            SET stats = '$estado', entregador = '$entregador', destinatario = '$destinatario'  
            WHERE id_guia = $id";
            
    $result = $conn->query($sql);
    if($estado=="ENTREGUE"){
        $destino = $_POST['destino'];
        $id_tombos = $_POST['tombos'];
        $search = "SELECT * FROM numero_tombos WHERE id_tombos = $id_tombos";
        $research = $conn->query($search);
        $row = mysqli_fetch_array($research);
        for($i=1; $i<=20; $i++){
            if($row[$i] != null){
                $sqlatt = "UPDATE etec_tombo SET id_departamento = $destino 
                WHERE numero_tombo = '".$row[$i]."'";
                echo $sqlatt;
                $r = $conn->query($sqlatt);
                if(!$r)
                    redirecionar($r);
            }else{break;}
        }
    }
    redirecionar($result);
}

else if(isset($_POST['Excluir'])){
    $id = $_POST['idguia'];
    $sql = "DELETE FROM etec_guias_lab WHERE id_guia = '$id'";
    $result1 = $conn->query($sql);
    if($result1){
        $id = $_POST['tombos'];
        $deletetabela = "DELETE FROM numero_tombos WHERE id_tombos = $id";
        $r = $conn->query($deletetabela);
        redirecionar($r);
    }
    redirecionar($result1);
}

function redirecionar($bol){
    if($bol){
        header("Location: ../Guia_transito/guias_transito.php");
    }else{
        //echo 'error';
        header("Location: ../ErroAdvice.html");
    }
}
?>