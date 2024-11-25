<?php
$host = 'localhost'; // ou o IP do seu servidor
$dbname = 'fascino';
$username = 'root'; // seu usuário MySQL
$password = ''; // sua senha do MySQL

try {
    // Conectando ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
