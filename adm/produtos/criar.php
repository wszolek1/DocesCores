<?php
require "../../src/conexao-bd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $destinoBanco = "upload/padrao.png"; 
    $destinoFisico = "../../upload/padrao.png";

    if (!empty($_FILES["imagem"]["name"])) {
        $nomeArquivo = $_FILES["imagem"]["name"];
        $caminhoTemp = $_FILES["imagem"]["tmp_name"];

        $destinoBanco = "upload/" . $nomeArquivo;
        $destinoFisico = "../../upload/" . $nomeArquivo;

        move_uploaded_file($caminhoTemp, $destinoFisico);
    }

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) 
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $destinoBanco
    ]);

    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../../css/form-produto.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Cadastrar Produto</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Descrição:</label>
        <textarea name="descricao" required></textarea>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" required>

        <label>Imagem:</label>
        <input type="file" name="imagem">

        <button type="submit">Cadastrar</button>
    </form>
</div>


</body>
</html>
