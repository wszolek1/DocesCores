<?php
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtosRepositorio = new ProdutoRepositorio($pdo);

// PAGINAÇÃO
$itens_por_pagina = filter_input(INPUT_GET, 'itens_por_pagina', FILTER_VALIDATE_INT) ?: 4;

$pagina_atual = isset($_GET['pagina']) ? max(1, (int)$_GET['pagina']) : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

$total_receitas = $produtosRepositorio->contarTotal();
$total_paginas = ceil($total_receitas / $itens_por_pagina);

$receitas = $produtosRepositorio->buscarPaginado(
    $itens_por_pagina,
    $offset,
    null,
    'ASC'
);
?>

<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocesCores - Receitas</title>
    <link rel="stylesheet" href="css/receitas.css">

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
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="sevicos.php">Serviços</a></li>
        <li><a href="receitas.php">Receitas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="carrinho/carrinho.php">Carrinho</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
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

    <!-- PAGINAÇÃO -->
    <div class="paginacao-site">

        <?php if ($pagina_atual > 1): ?>
            <a href="?pagina=<?= $pagina_atual - 1 ?>&itens_por_pagina=<?= $itens_por_pagina ?>" class="seta-pag"><-</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <?php if ($i == $pagina_atual): ?>
                <strong class="pagina-atual"><?= $i ?></strong>
            <?php else: ?>
                <a class="pagina-link" href="?pagina=<?= $i ?>&itens_por_pagina=<?= $itens_por_pagina ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($pagina_atual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?>&itens_por_pagina=<?= $itens_por_pagina ?>" class="seta-pag">-></a>
        <?php endif; ?>

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
