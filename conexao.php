<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'etec_adm_teste';
// Conecta-se ao banco de dados MySQL
$conn = new mysqli($servidor, $usuario, $senha, $banco);
$conn->set_charset("utf8");

// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>
