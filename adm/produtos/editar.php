<?php
require "../../src/conexao-bd.php";

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    if (!empty($_FILES['imagem']['name'])) {

        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoTemp = $_FILES['imagem']['tmp_name'];

        $imgFisico = "../../upload/" . $nomeArquivo;
        move_uploaded_file($caminhoTemp, $imgFisico);

        $imgBanco = "upload/" . $nomeArquivo;

    } else {
        $imgBanco = $produto['imagem'];
    }

    $sql = "UPDATE produtos 
            SET nome=?, descricao=?, preco=?, imagem=?
            WHERE id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $preco, $imgBanco, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../css/form-produto.css">
</head>
<body>

<div class="container">
    <h2>Editar Produto</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Nome:</label>
        <input name="nome" value="<?= $produto['nome'] ?>">

        <label>Descrição:</label>
        <textarea name="descricao"><?= $produto['descricao'] ?></textarea>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>">

        <label>Imagem atual:</label>
        <div class="imagem-preview">
            <img src="../<?= $produto['imagem'] ?>">
        </div>

        <label>Nova imagem (opcional):</label>
        <input type="file" name="imagem">

        <button type="submit">Salvar</button>
    </form>
</div>

</body>
</html>
