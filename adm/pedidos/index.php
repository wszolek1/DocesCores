<?php
require "../../src/conexao-bd.php";
require "../../src/Modelo/Pedido.php";
require "../../src/Repositorio/PedidoRepositorio.php";

$repo = new PedidoRepositorio($pdo);

// ORDENAÇÃO
$ordem = filter_input(INPUT_GET, 'ordem') ?: null;
$direcao = filter_input(INPUT_GET, 'direcao') ?: 'ASC';

// Busca pedidos ordenados
$pedidos = $repo->listarOrdenado($ordem, $direcao);

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
    <title>Admin - Pedidos</title>

    <link rel="stylesheet" href="../../css/pedidos.css">

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

<div class="container">
    <h2>Gerenciar Pedidos</h2>

    <table>
        <tr>
            <th>
                <a href="<?= gerarUrlOrdenacao('id', $ordem, $direcao) ?>">
                    ID <?= iconeOrdenacao('id', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('cliente', $ordem, $direcao) ?>">
                    Cliente <?= iconeOrdenacao('cliente', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('produto', $ordem, $direcao) ?>">
                    Produto <?= iconeOrdenacao('produto', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('quantidade', $ordem, $direcao) ?>">
                    Qtd <?= iconeOrdenacao('quantidade', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('status', $ordem, $direcao) ?>">
                    Status <?= iconeOrdenacao('status', $ordem, $direcao) ?>
                </a>
            </th>

            <th>
                <a href="<?= gerarUrlOrdenacao('data_pedido', $ordem, $direcao) ?>">
                    Data <?= iconeOrdenacao('data_pedido', $ordem, $direcao) ?>
                </a>
            </th>

            <th>Ações</th>
        </tr>

        <?php foreach ($pedidos as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= htmlspecialchars($p->getNomeCliente()) ?></td>
                <td><?= htmlspecialchars($p->getProduto()) ?></td>
                <td><?= $p->getQuantidade() ?></td>
                <td><?= htmlspecialchars($p->getStatus()) ?></td>
                <td><?= $p->getDataPedido() ?></td>

                <td class="acoes">
                    <a class="btn-editar" href="editar.php?id=<?= $p->getId() ?>">Editar</a>
                    <a class="btn-excluir" href="excluir.php?id=<?= $p->getId() ?>"
                       onclick="return confirm('Excluir pedido?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
