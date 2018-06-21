<?php
include_once("../conexao.php");

if(isset($_POST['Criar'])){
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $sql = "INSERT INTO etec_departamento(nome, idpolo, isestoque) VALUES('$nome', $local, 1)";
}
else if(isset($_POST['Editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $sql = "UPDATE etec_departamento 
            SET nome = '$nome', idpolo = $local 
            WHERE id_departamento = $id";
}

echo $sql;
$result = $conn->query($sql);

if($result){
    //echo 'sucesso';
    header("Location: ../index.php");
}else{
    echo 'falha';
    //header("Location: ../ErroAdvice.html");
}
?>