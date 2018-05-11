<?php
include_once("../conexao.php");
//setorDestino, ids[], qtds[], solicitado, autorizado, recebido
$idsCosumo = $_POST['ids'];
$quats = $_POST['qtds'];
$destino = ['setorDestino'];
$solicitante = $_POST['solicitado'];
$autorizador = $_POST['autorizado'];
$recebido = $_POST['recebido'];


?>