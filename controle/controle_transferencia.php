<?php
include_once("../conexao.php");

$iddp = $_POST['setorOrigem'];
$tombo = $_POST['ntombo'];
$iddestino = $_POST['setorDestino'];
$responsavel = $_POST['resp'];
$justificativa = $_POST['just'];
$entregador = $_POST['entregador'];
$destinatario = $_POST['destinatario'];

$sqltombo = "INSERT INTO numero_tombos (t1) VALUES ('$tombo')";
$res = $conn->query($sqltombo);
if($res){
    $id = mysqli_insert_id($conn);
    $sql = "INSERT INTO etec_guias_lab (id_tombos, id_origem, id_destino, responsavel, justificativa, 
                                        entregador, destinatario, dia, mes, ano, stats) 
            VALUES ('$id', '$iddp', '$iddestino', '$responsavel', '$justificativa', '$entregador', '$destinatario',
                    day(CURRENT_DATE), month(CURRENT_DATE), year(CURRENT_DATE), 'ESPERANDO')";
    $result = $conn->query($sql);
    redirecionar($result);
}else{
    redirecionar($res);
}

function redirecionar($bol){
    if($bol){
        header("Location: ../index.php");
    }else{
        //echo 'error';
        header("Location: ../ErroAdvice.html");
    }
}
?>
