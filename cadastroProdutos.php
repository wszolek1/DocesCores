<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_DocesCores";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];

    $stmt = $conn->prepare("INSERT INTO tb_produtos (nome, descricao, preco) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nome, $descricao, $preco);

    if ($stmt->execute()) {
        echo "<script>alert('Produto cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar produto.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
     <section class="container-form">
            <form action="#">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do produto">

                <label for="tipo">Tipo</label>
                <div class="container-radio">
                    <div>
                        <label for="cafe">Café</label>
                        <input type="radio" name="tipo" id="cafe" value="cafe">
                    </div>
                    <div>
                        <label for="almoco">Almoço</label>
                        <input type="radio" name="tipo" id="almoco" value="almoco">
                    </div>
                </div>

                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do produto">

                <label for="preco">Preço</label>
                <input type="text" name="preco" id="preco" placeholder="Digite o preço do produto">

                <label for="imagem">Envie uma imagem do produto</label>
                <input type="file" name="imagem" id="imagem" accept="image/*">

                <input class="botao-cadastrar" type="submit" name="cadastro" value="Cadastrar produto">

            </form>
        </section>
</body>
</html>