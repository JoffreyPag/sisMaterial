<?php
include_once("../conexao.php");
$materials = $_POST['materiais'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Guia - Selecionar tombo</title>
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
<a href="../Guia_transito/novoGuia1.php">Voltar</a>

    <form action="novoGuia2.php" method="post">
        <select name="estoque" id="">
            <?php
                $estoquesql = "SELECT d.id_departamento, d.nome, p.municipio, p.cidade FROM etec_departamento d 
                INNER JOIN etec_polo p ON p.idpolo = d.idpolo 
                WHERE isestoque = true";
                $estoqueresultado = $conn->query($estoquesql);
                while($row = mysqli_fetch_array($estoqueresultado)){
                    echo '<option value="'.$row['id_departamento'].'">'.$row['municipio'].'/'.$row['cidade'].' - '.$row['nome'].'</option>';
                }
            ?>
        </select>
        <?php
            foreach($materials as $mat){
                echo '<input type="hidden" name="materiais[]" value='.$mat.'>';
            }
        ?>
        <input type="submit" value="Pesquisar">
    </form>

    <?php
        if(isset($_POST['estoque'])){
            $idestoque = $_POST['estoque'];
            echo '<form action="novoGuia3.php" method="post">
                    <input type="hidden" name="departamento" value="'.$idestoque.'">';
            foreach ($materials as $mat) {
                $dtl = explode(':', $mat);

                echo '<table border=1>
                        <tr>
                            <td colspan=2>'.$dtl[1].'</td>
                        </tr>';
                $sql = "SELECT t.numero_tombo FROM etec_tombo t 
                        INNER JOIN etec_departamento d ON t.id_departamento = d.id_departamento
                        INNER JOIN etec_materiais_permanentes p ON p.id_permanente = ".$dtl[0]."
                        WHERE d.isestoque = true AND t.id_material = p.id_permanente AND d.id_departamento = ".$idestoque."";
                
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr>
                                <td><input type="checkbox" name="nTombos[]" value="'.$row['numero_tombo'].'" ></td>
                                <td>'.$row['numero_tombo'].'</td>
                            </tr>';
                    }
                }else{
                    echo '<tr>
                            <td><p>Indisponivel</h4></p>
                        </tr>';
                }
                echo '</table>';
            }
            echo '<br/><input type="submit" value="Continuar" id="checkBtn">
            </form>';

        }else{
            echo '<h4>Informe um estoque que deseja procurar</h4>';
        }
    ?>       
</body>
</html>