<?php
include_once("../conexao.php");

if(isset($_POST['tipoMaterial'])){

    switch($_POST['tipoMaterial']){
        case 'permanente':

            if(isset($_POST['Excluir'])){
                $id = $_POST['Excluir'];
                $sql = "DELETE FROM etec_materiais_permanentes WHERE id_permanente = '$id'";
            }else{
        
                $espec = $_POST["Especificacao"];
                $acess = $_POST["Acessorios"];
        
                if(isset($_POST['Cadastrar'])){
        
                    $sql = "INSERT INTO etec_materiais_permanentes(especificacao, acessorio) VALUES('$espec','$acess')";
        
                }elseif(isset($_POST['Atualizar'])){
        
                    $id = $_POST['Atualizar'];
        
                    $sql = "UPDATE etec_materiais_permanentes 
                            SET especificacao = '$espec', acessorio = '$acess' WHERE id_permanente = '$id'";    
                }
            }
        break;

        case 'consumo':
            $qtd = $_POST['quantidade'];
            if(isset($_POST['Excluir'])){
                $id = $_POST['Excluir'];
                $sql = "DELETE FROM etec_materiais_consumo WHERE id_consumo = '$id'";
            }else{

                $espec = $_POST["Especificacao"];
                $qtd = $_POST["quantidade"];

                if(isset($_POST['Cadastrar'])){
                    $sql = "INSERT INTO etec_materiais_consumo(quantidade, especificacao, id_departamento) VALUES('$qtd','$espec', 7)";
                }elseif(isset($_POST['Atualizar'])){

                    $id = $_POST['Atualizar'];

                    $sql = "UPDATE etec_materiais_consumo
                            SET especificacao = '$espec', quantidade = '$qtd'
                            WHERE id_consumo = '$id'";
                }
            }
        break;
    }
}

$result = $conn->query($sql);

if($result){
    header("Location: ../index.php");
}else{
    //echo 'falha';
    header("Location: ../ErroAdvice.html");
}

?>