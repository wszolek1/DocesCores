<?php
require "../src/conexao-bd.php";
require "../src/Modelo/Produto.php";
require "../src/Repositorio/ProdutoRepositorio.php";

$repo = new ProdutoRepositorio($pdo);
$produtos = $repo->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produtos</title>
    <link rel="stylesheet" href="../css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>

<!-- HEADER -->
<div class="header">
    <ul>
        <li><a href="../pag1.html">Inicio</a></li>
        <li><a href="../pag2.html">Serviços</a></li>
        <li><a href="../pag3.php">Receitas</a></li>
        <li><a href="../pag4.html">Sobre</a></li>
        <li><a href="../login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">

    <div class="titulo">
        <h1>Gerenciar Produtos</h1>
    </div>

    <div class="topo-admin">
        <a class="btn-criar" href="criar.php">➕ Cadastrar produto</a>
    </div>

    <table class="tabela">
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><img src="../<?= $p->getImagemDiretorio() ?>" width="80"></td>
                <td><?= $p->getNome() ?></td>
                <td><?= $p->getPrecoFormatado() ?></td>
                <td>
                    <a class="editar" href="editar.php?id=<?= $p->getId() ?>">Editar</a> | 
                    <a class="excluir" href="excluir.php?id=<?= $p->getId() ?>"
                       onclick="return confirm('Excluir mesmo?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<!-- RODAPÉ -->
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
