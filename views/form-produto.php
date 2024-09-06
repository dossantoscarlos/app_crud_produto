<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form action="/produto/save" method="POST">
        <label for="descricao">Descrição:</label><br>
        <input type="text" id="descricao" name="descricao" required><br><br>

        <label for="qtde">Quantidade:</label><br>
        <input type="number" id="qtde" name="qtde" required><br><br>

        <label for="preco">Preço:</label><br>
        <input type="text" id="preco" name="preco" required><br><br>

        <label for="data_vcto">Data de Vencimento:</label><br>
        <input type="date" id="data_vcto" name="data_vcto" required><br><br>

        <label for="grupo_id">Grupo ID:</label><br>
        <input type="number" id="grupo_id" name="grupo_id" required><br><br>

        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
