<?php
include_once("../conexao.php");
$sql = "SELECT c.id_consumo, c.especificacao, c.quantidade, c.id_departamento, c.unidade, d.nome, p.cidade FROM etec_materiais_consumo c 
        INNER JOIN etec_departamento d ON c.id_departamento = d.id_departamento 
        INNER JOIN etec_polo p ON d.idpolo = p.idpolo";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materiais de Consumo</title>
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
    <h3>Requisição interna de material de consumo</h3>
    <a href="../index.php">Voltar</a>
    <br><br>
    <form action="Documento_requisicao.php" method="post">
        <table border =1 >
            <tr>
                <th>Especificação</th>
                <th>Quantidade</th>
                <th>Estoque</th>
            </tr>
            <?php
                while($row = mysqli_fetch_array($result)){
                    echo '<tr>
                            <td>'.$row['especificacao'].'</td>
                            <td>'.(($row['quantidade'] <= 0)? 'Esgotado' : $row['quantidade']).'</td>
                            <td>'.$row['cidade'].'/'.$row['nome'].'</td>
                            <td>
                                '.(($row['quantidade']<=0)? '' : '<input type="checkbox" name="materiais[]" value="'.$row['id_consumo'].':'.$row['especificacao'].':'.$row['quantidade'].':'.$row['unidade'].'">').'
                            </td>
                        </tr>';
                }
            ?>
        </table>
        <br>
        <input type="submit" value="Solicitar" id="checkBtn">
    </form>
</body>
</html>