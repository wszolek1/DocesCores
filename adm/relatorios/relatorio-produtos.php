<?php
require "../../src/conexao-bd.php";
require "../../src/Modelo/Produto.php";
require "../../src/Repositorio/ProdutoRepositorio.php";

date_default_timezone_set('America/Sao_Paulo');
$rodapeDataHora = date('d/m/Y H:i');

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtos = $produtoRepositorio->listarTodos();
?>
<head>
    <meta charset="UTF-8">

<style>
    body, table, th, td, h3 {
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
        width: 90%;
        margin: auto;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #000;
    }

    th {
        font-weight: bold;
        font-size: 14px;
        padding: 8px;
        background: #f4f4f4;
        text-align: left;
    }

    td {
        font-size: 12px;
        padding: 8px;
    }

    h3 {
        text-align: center;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
    }

    .pdf-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px;
        text-align: center;
        font-size: 12px;
        color: #444;
        border-top: 1px solid #ddd;
        padding-top: 6px;
        background: white;
    }

    body {
        margin-bottom: 60px;
        margin-top: 0;
    }
</style>
</head>

<h3>Listagem de produtos</h3>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= htmlspecialchars($produto->getNome()) ?></td>
                <td><?= htmlspecialchars($produto->getDescricao()) ?></td>
                <td><?= htmlspecialchars($produto->getPrecoFormatado()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pdf-footer">
    Gerado em: <?= htmlspecialchars($rodapeDataHora) ?>
</div>
