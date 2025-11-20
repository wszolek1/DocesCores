<?php
require "../src/conexao-bd.php";
require "../src/Modelo/Produto.php";
require "../src/Repositorio/ProdutoRepositorio.php";

$repo = new ProdutoRepositorio($pdo);
$produtos = $repo->listarTodos();
?>

<h2>Produtos cadastrados</h2>
<a href="criar.php">➕ Cadastrar produto</a>
<br><br>

<table border="1" cellpadding="10">
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
            <td><img src="<?= $p->getImagemDiretorio() ?>" width="80"></td>
            <td><?= $p->getNome() ?></td>
            <td><?= $p->getPrecoFormatado() ?></td>
            <td>
                <a href="editar.php?id=<?= $p->getId() ?>">Editar</a> | 
                <a href="excluir.php?id=<?= $p->getId() ?>"
                   onclick="return confirm('Excluir mesmo?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
