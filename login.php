<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<header>
<div class="container">
<h1>✨Fascino✨</h1>
<nav>
<ul>
<li><a href="principal.php">Início</a></li>
<li><a href="carrinho.php">Carrinho</a></li>
</nav>
</div>
</header>
<h2>Login</h2>
<form method="POST" action="">
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" id="telefone" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required>
    </div>

    <div class="form-group">
        <label for="num_cart">Número do cartão:</label>
        <input type="number" name="num_cart" id="num_cart" required>
    </div>

    <button type="submit">Enviar</button>
</form>

<?php
require_once("class/db.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexão com o banco de dados
    $con = new Database();
    $link = $con->getConexao();

    // Recebendo os dados do formulário
    $nome = $_POST['name'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $num_cartao = $_POST['num_cart'];

    // Preparando a consulta SQL para evitar SQL Injection
    $stmt = $link->prepare("INSERT INTO clientes (nome, telefone, email, cpf, num_cartao) 
                            VALUES (:nome, :telefone, :email, :cpf, :num_cartao)");

    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':num_cartao', $num_cartao);

    // Executando a consulta
    if ($stmt->execute()) {
        echo "Olá $nome, boas compras!";
    } else {
        echo "Erro ao registrar os dados.";
    }
}
?>

</body>
</html>
