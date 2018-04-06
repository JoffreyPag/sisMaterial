<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Material</title>
</head>
<body>
    <form action="controle/processo_material.php" method="POST">
        <table>
            <tr>
                <th><label for="Especificacao">Especificação:</label></th>
                <td><input type="text" name="Especificacao" id="Especificacao" required></td>
            </tr>
            <tr>
                <th><label for="Acessorios">Acessorios:</label></th>
                <td><input type="text" name="Acessorios" id="Acessorios" value=" - "></td>
            </tr>
            <tr>
                <th><label for="Quantdade">Quantidade:</label></th>
                <td><input type="number" name="quantidade" id="Quantdade" value="0" min="0"></td>
            </tr>
            <tr>
                <td><input type="radio" name="tipoMaterial" value="consumo"> Consumo </input></td>
                <td><input type="radio" name="tipoMaterial" value="permanente" checked>Permanente</input></td>
            </tr>
            <tr>
                <td colspan = "2">
                    <input type="submit" value="Cadastrar" name="Cadastrar">    
                </td>
            </tr>
        </table>
    </form>
</body>
</html>