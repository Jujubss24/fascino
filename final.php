<?php
session_start();

$produtos = [
    1 => ['nome' => 'Colar em Ouro', 'preco' => 1199.90],
    2 => ['nome' => 'Anel em Prata', 'preco' => 299.90],
    3 => ['nome' => 'Pulseira em Prata', 'preco' => 999.90],
    4 => ['nome' => 'Anel em Prata', 'preco' => 49.90],
];

$total = 0;
if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $id => $item) {
        $total += $item['preco'] * $item['quantidade'];
    }
}

if (empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fascino - Finalização de Compra</title>
    <link rel="stylesheet" href="final.css">
</head>
<body>
    <header>
      <div class="container">
         <h1>✨Fascino✨</h1>
         <nav>
             <ul>
              <li><a href="principal.php">Início</a></li>
              <li><a href="carrinho.php">Carrinho</a></li> <!-- Link para a página do carrinho -->
             </ul>
         </nav>
      </div>
    </header>

    <div class="container">
        <header>
            <h1>Obrigado pela sua compra!</h1>
        </header>
        <main>
            <p class="success-message">Sua compra foi confirmada com sucesso!</p>

            <h2>Detalhes do Pedido:</h2>
            
            <div class="order-details">
                <?php foreach ($_SESSION['carrinho'] as $id => $item): ?>
                    <p><strong>Produto:</strong> <?php echo $item['nome']; ?></p>
                    <p><strong>Quantidade:</strong> <?php echo $item['quantidade']; ?></p>
                    <p><strong>Preço Unitário:</strong> R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                    <p><strong>Total:</strong> R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></p>
                    <hr>
                <?php endforeach; ?>
            </div>

            <p class="total"><strong>Total da Compra:</strong> R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
        </main>

        <footer>
            <p>Se você tiver alguma dúvida, entre em contato conosco.</p>
        </footer>
    </div>
</body>
</html>
