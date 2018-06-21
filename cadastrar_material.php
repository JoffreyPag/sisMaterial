<?php
    include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Material</title>
    <link rel="stylesheet" href="CSS/stylecadastromaterial.css">
</head>
<body>
    <script type="text/javascript">
        function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.visibility = 'visible';
        }
        else document.getElementById('ifYes').style.visibility = 'hidden';
       }
    </script>
    <form action="controle/processo_material.php" method="post">
        <div>
            <div>
                <label for="Especificacao">Especificação:</label>
                <input type="text" name="Especificacao" id="Especificacao" required>
            </div>
            <br>
            <div>
                <label for="Acessorios">Acessorios:</label>
                <input type="text" name="Acessorios" id="Acessorios" value=" - ">
            </div>
            <br>
            <div>
                <input type="radio" onclick="javascript:yesnoCheck();" name="tipoMaterial" value="permanente" id="noCheck" checked> Permanente </input>
                <input type="radio" onclick="javascript:yesnoCheck();" name="tipoMaterial" value="consumo" id="yesCheck"> Consumo </input><br>
                <div id="ifYes" style="visibility:hidden">
                    <br>
                    <label for="Quantdade">Quantidade:</label>
                    <input type="number" name="quantidade" id="Quantdade" value="0" min="0">
                    <br>
                    <label for="Unidade">Unidade:</label>
                    <input type="text" name="unidade" id="unidade">
                    <br>
                    <label for="Estoque">Estoque:</label>
                    <select name="local">
                        <?php
                            $sql = "SELECT d.id_departamento, d.nome, p.cidade FROM etec_departamento d INNER JOIN adm_mand_polo p ON d.idpolo = p.idpolo WHERE isestoque = 1";
                            $result = $conn->query($sql);
                            while($row = mysqli_fetch_array($result)){
                                echo ' <option value="'.$row['id_departamento'].'">'.$row['cidade'].' - '.$row['nome'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div>
                <input type="submit" value="Cadastrar" name="Cadastrar">
            </div>
        </div>
    </form>
</body>
</html>