<?php
require "../../src/conexao-bd.php";
require "../../src/Modelo/Produto.php";
require "../../src/Repositorio/ProdutoRepositorio.php";

$repo = new ProdutoRepositorio($pdo);


// ORDENAÇÃO
$ordem = filter_input(INPUT_GET, 'ordem') ?: null;
$direcao = filter_input(INPUT_GET, 'direcao') ?: 'ASC';


$produtos = $repo->buscarTodosOrdenado($ordem, $direcao);

// Função para gerar URL de ordenação
function gerarUrlOrdenacao($campo, $ordemAtual, $direcaoAtual)
{
    $novaDirecao = ($ordemAtual === $campo && $direcaoAtual === 'ASC') ? 'DESC' : 'ASC';
    return "?ordem={$campo}&direcao={$novaDirecao}";
}

// Ícone da setinha
function iconeOrdenacao($campo, $ordemAtual, $direcaoAtual)
{
    if ($ordemAtual !== $campo) {
        return "↕️";
    }
    return $direcaoAtual === "ASC" ? "↑" : "↓";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produtos</title>
    <link rel="stylesheet" href="../../css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
    <ul>
        <li><a href="../../inicio.php">Inicio</a></li>
        <li><a href="../../sevicos.php">Serviços</a></li>
        <li><a href="../../receitas.php">Receitas</a></li>
        <li><a href="../../sobre.php">Sobre</a></li>
        <li><a href="../../logout.php">Logout</a></li>
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
            <th>
                <a href="<?= gerarUrlOrdenacao('id', $ordem, $direcao) ?>" class="ordem">
                    ID <?= iconeOrdenacao('id', $ordem, $direcao) ?>
                </a>
            </th>

            <th>Imagem</th>

            <th>
                <a href="<?= gerarUrlOrdenacao('nome', $ordem, $direcao) ?>" class="ordem">
                    Nome <?= iconeOrdenacao('nome', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('preco', $ordem, $direcao) ?>" class="ordem">
                    Preço <?= iconeOrdenacao('preco', $ordem, $direcao) ?>
                </a>
            </th>

            <th>Ações</th>
        </tr>

        <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><img src="../../<?= $p->getImagemDiretorio() ?>" width="80"></td>
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

</body>
</html>
