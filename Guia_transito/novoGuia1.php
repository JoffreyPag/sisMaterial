<?php
include_once("../conexao.php");
//TODO:
//LISTAR ALL MATERIAIS QUE TEM CADASTRADOS E DO LADO UM CHECK BOX
//NA SEGUDA ETAPA IRA BUSCAR DOS CHECKBOX SELECIOANDOS QUAIS TOMBOS DE CADA MATERIAL TEM EM ESTOQUE
//NA SEGUNDA ETAPA TERA CHECKBOX PARA CADA TOMBO DE TODOS OS MATERIAS PARA LEVAR PRA TERCEIRA ETAPA
//NA TERCEIRA LISTA TODOS OS TOMBOS SELECIONADOS

$sql = "SELECT id_permanente, especificacao, acessorio FROM etec_materiais_permanentes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Guia - Selecionar material</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">
$(document).ready(function () {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("Você deve escolher ao menos um item para continuar.");
        return false;
      }

    });
});

</script>
<a href="../Guia_transito/guias_transito.php">Voltar</a>
    <form action="novoGuia2.php" method="post">
        <table>
            <tr>
                <th></th>
                <th>Especificação</th>
                <th>Acessorios</th>
            </tr>
    
        <?php
            //<input type="checkbox" name="nTombos[]" value="'.$row['numero_tombo'].'">
            while($row = mysqli_fetch_array($result)){

                echo '<tr>
                        <td>
                            <input type="checkbox" name="materiais[]" value="'.$row['id_permanente'].':'.$row['especificacao'].':'.$row['acessorio'].'">
                        </td>
                        <td>'.$row['especificacao'].'</td>
                        <td>'.$row['acessorio'].'</td>
                    </tr>';
            }
        ?>
        </table>
        <input type="submit" value="Confirmar" id="checkBtn">
    </form>
</body>
</html>