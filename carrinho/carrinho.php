<?php
session_start();
require "../src/conexao-bd.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("
    SELECT c.id AS carrinho_id, c.quantidade, 
           p.nome, p.preco, p.imagem
    FROM carrinho c
    JOIN produtos p ON p.id = c.produto_id
    WHERE c.usuario_id = ?
");
$stmt->execute([$usuario_id]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - DocesCores</title>
    <link rel="stylesheet" href="../css/carrinho.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

</head>

<body>

<div class="header">
    <ul>
        <li><a href="../pag1.html">Inicio</a></li>
        <li><a href="../pag2.html">Serviços</a></li>
        <li><a href="../pag3.php">Receitas</a></li>
        <li><a href="../pag4.html">Sobre</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="../login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">
    <div class="titulo">
        <h1>Seu Carrinho</h1>
    </div>

    <?php if (count($itens) == 0): ?>
        <p class="vazio">Seu carrinho está vazio 🍰</p>
    <?php else: ?>

        <div class="lista-carrinho">

            <?php foreach ($itens as $item): ?>
                <div class="item">

                    <img src="../<?= htmlspecialchars($item['imagem']) ?>">

                    <div class="info">
                        <h2><?= $item['nome'] ?></h2>
                        <p>Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>

                        <div class="acoes">
                            <a href="diminuir.php?id=<?= $item['carrinho_id'] ?>">-</a>
                            <span><?= $item['quantidade'] ?></span>
                            <a href="aumentar.php?id=<?= $item['carrinho_id'] ?>">+</a>
                        </div>

                        <a class="remover" href="remover.php?id=<?= $item['carrinho_id'] ?>">Remover</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="botao-finalizar">
            <a href="finalizar.php">Finalizar Pedido</a>
        </div>

    <?php endif; ?>
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
