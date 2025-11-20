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

    // futura implementação (apagar por enquanto porque seu banco NÃO tem categoria)
    public function listarPorCategoria(string $categoria): array
    {
        return []; // não existe coluna categoria no banco
    }
}
