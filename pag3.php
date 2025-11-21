<?php
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtosRepositorio = new ProdutoRepositorio($pdo);

$receitas = $produtosRepositorio->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocesCores - Receitas</title>
    <link rel="stylesheet" href="css/pag3.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Pacifico&family=Raleway:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

<div class="header">
    <ul>
        <li><a href="pag1.html">Inicio</a></li>
        <li><a href="pag2.html">Serviços</a></li>
        <li><a href="pag3.php">Receitas</a></li>
        <li><a href="pag4.html">Sobre</a></li>
        <li><a href="carrinho/carrinho.php">Carrinho</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">
    <div class="texto">
        <h1>Escolhidos da casa</h1>
        <p>Essas são algumas de nossas receitas feitas com carinho para você</p>
    </div>

    <div class="receitas">

        <?php foreach ($receitas as $produto): ?>
            <a class="receitaLink" href="produto.php?id=<?= $produto->getId() ?>">
                <div class="receitaItem">
                    <img src="<?= $produto->getImagemDiretorio() ?>">
                    <p>
                        <?= $produto->getDescricao() ?><br><br>
                        <?= $produto->getPrecoFormatado() ?>
                    </p>
                </div>
            </a>
        <?php endforeach; ?>

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
