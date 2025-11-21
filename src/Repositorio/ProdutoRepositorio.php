<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // pega TODOS os produtos
    public function listarTodos(): array
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->pdo->query($sql);

        $produtos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produtos[] = new Produto(
                $row['id'],
                $row['nome'],
                $row['descricao'],
                floatval($row['preco']),
                $row['imagem']
            );
        }

        return $produtos;
    }

}
