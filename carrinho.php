<?php
session_start();
require_once 'conexao.php'; // Inclui a conexão com o banco

// Verifica se o carrinho já existe na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Função para adicionar um produto ao carrinho
if (isset($_GET['adicionar'])) {
    $produto_id = $_GET['adicionar'];

    // Consulta o produto no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->execute(['id' => $produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        // Verifica se o produto já está no carrinho
        $existe = false;
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $produto['id']) {
                $item['quantidade'] += 1;
                $existe = true;
                break;
            }
        }

        // Se o produto não estiver no carrinho, adiciona-o
        if (!$existe) {
            $_SESSION['carrinho'][] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'quantidade' => 1,
                'preco' => $produto['preco']
            ];
        }
    }
}

// Função para remover um produto do carrinho
if (isset($_GET['remover'])) {
    $index = $_GET['remover'];
    unset($_SESSION['carrinho'][$index]); // Remove o produto do carrinho
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array
}

// Calcular o total
$total = 0;
foreach ($_SESSION['carrinho'] as $produto) {
    $total += $produto['quantidade'] * $produto['preco'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="carrinho.css">
    <title>Carrinho de Compras - Fascino</title>
</head>
<body>
    <header>
        <h1>✨Fascino✨</h1>
        <nav>
            <a href="principal.php">Início</a>
        </nav>
    </header>
    <main>
        <h2>Carrinho de Compras</h2>
        <table id="carrinho-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrinho'] as $index => $produto): ?>
                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($produto['quantidade'] * $produto['preco'], 2, ',', '.'); ?></td>
                        <td><a href="?remover=<?php echo $index; ?>"><button>Remover</button></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <a href="final.php"><button>Finalizar compra</button></a>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Fascino Joias. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
