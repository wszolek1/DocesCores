<?php
require "src/conexao-bd.php";

if (!isset($_GET['id'])) {
    die("Produto não encontrado!");
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) {
    die("Produto não existe.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($p['nome']) ?> - DocesCores</title>

    <link rel="stylesheet" href="css/produto.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>

<div class="header">
    <ul>
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="sevicos.php">Serviços</a></li>
        <li><a href="receitas.php">Receitas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="carrinho/carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">

    <div class="produto-box">

        <!-- Imagem do produto-->
        <img class="img-produto" src="<?= htmlspecialchars($p['imagem']) ?>">

        <div class="info">

            <h1><?= htmlspecialchars($p['nome']) ?></h1>

            <p class="descricao">
                <?= nl2br(htmlspecialchars($p['descricao'])) ?>
            </p>

            <p class="preco">
                Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?>
            </p>

            <form action="carrinho/adicionar.php" method="POST">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button class="btn-add" type="submit">Adicionar ao carrinho</button>
            </form>

        </div>

    </div>

</div>

<div class="rodape">
    <ul>
        <li>
            <span>Contato</span>
            <span class="info"> 55 41 99999-9999</span>
        </li>
        <li>
            <span>Rua João Negrão</span>
            <span class="info">Curitiba, Paraná</span>
        </li>
        <li>
            <span>Horário de funcionamento</span>
            <span class="info">Seg - Sex, 10:00 - 19:00</span>
        </li>
    </ul>
</div>

</body>
</html>
