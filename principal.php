<?php 
session_start();

$produtos = [
    1 => ['modelo' => 'Colar em Ouro', 'preco' => 1199.90, 'imagem' => 'colarouro.jpg'],
    2 => ['modelo' => 'colar em Prata', 'preco' => 999.90, 'imagem' => 'colarprata.jpg'],
    3 => ['modelo' => 'Colar em Ouro', 'preco' => 199.90, 'imagem' => 'colarouro2.jpg'],
    4 => ['modelo' => 'Pulseira em Prata', 'preco' => 999.90, 'imagem' => 'pulseiraprata2.jpg'],
    5 => ['modelo' => 'Pulseiera em Ouro', 'preco' => 299.90, 'imagem' => 'pulseiraouro.jpg'],
    6 => ['modelo' => 'Tornozeleira em Prata', 'preco' => 199.90, 'imagem' => 'tornozeleiraprata.jpg'],
    7 => ['modelo' => 'Anel em Prata', 'preco' => 199.90, 'imagem' => 'anelprata2.jpg'],
    8 => ['modelo' => 'Anel em Ouro', 'preco' => 299.90, 'imagem' => 'anelouro2.jpg'],
    9 => ['modelo' => 'Anel em Prata', 'preco' => 99.90, 'imagem' => 'anelprata.jpg'],
    10 => ['modelo' => 'Anel em Prata', 'preco' => 199.90, 'imagem' => 'anelprata5.jpg'],
    11 => ['modelo' => 'Anel em Prata', 'preco' => 439.90, 'imagem' => 'anelprata4.jpg'],
    12 => ['modelo' => 'Anel em Prata', 'preco' => 189.90, 'imagem' => 'anelprata6.jpg'],
    13 => ['modelo' => 'Colar em Prata', 'preco' => 159.90, 'imagem' => 'colarprata2.jpg'],
    14 => ['modelo' => 'Anel em Prata', 'preco' => 189.90, 'imagem' => 'anelprata7.jpg'],
    15 => ['modelo' => 'Colar em Ouro', 'preco' => 199.90, 'imagem' => 'colarouro3.jpg'],

];

if (isset($_GET['add'])) {
    $produto_id = $_GET['add'];

    if (isset($produtos[$produto_id])) {
        $produto = $produtos[$produto_id];

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$produto_id] = [
                'nome' => $produto['modelo'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fascino - Loja de Joias</title>
    <link rel="stylesheet" href="inicio.css">
</head>
<body>

<header>
    <div class="container">
        <h1>✨Fascino✨</h1>
        <nav>
            <ul>
                <li><a href="#home">Início</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="#products">Produtos</a></li>
                <li><a href="#about">Sobre Nós</a></li>
                <li><a href="carrinho.php">Carrinho</a></li> <!-- Link para a página do carrinho -->
            </ul>
        </nav>
    </div>
</header>

<section id="home">
    <div class="hero">
        <h2>Joias em Prata e Ouro</h2>
        <p>Descubra a elegância e sofisticação das nossas joias!</p>
    </div>
</section>

<section id="products">
    <div class="container">
        <h2>Produtos</h2>
        <div class="product-grid">
            <?php foreach ($produtos as $id => $produto): ?>
                <div class="product-item">
                    <img src="<?php echo $produto['imagem']; ?>" alt="Produto: <?php echo $produto['modelo']; ?>">
                    <h3><?php echo $produto['modelo']; ?></h3>
                    <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    <a href="?add=<?php echo $id; ?>"><button>Adicionar ao Carrinho</button></a> 
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="about">
    <div class="container">
        <h2>Sobre Nós</h2>
        <p>Em uma charmosa rua de Paris, sob a sombra da Torre Eiffel, estava a loja de joias Fascino. Este lugar mágico era um verdadeiro refúgio para amantes de beleza e elegância...</p>
    </div>
</section>

<footer>
    <div class="container">
        <center><p>&copy; 2024 Fascino Joias. Todos os direitos reservados.</p></center>
    </div>
</footer>

</body>
</html>
