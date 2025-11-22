<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Método de paginação
    public function buscarPaginado(int $limite, int $offset, ?string $ordem = null, string $direcao = 'ASC'): array
    {
        $camposPermitidos = ['descricao', 'preco', 'nome'];
        $ordemSql = '';

        if ($ordem && in_array($ordem, $camposPermitidos)) {
            $direcao = strtoupper($direcao) === 'DESC' ? 'DESC' : 'ASC';
            $ordemSql = "ORDER BY {$ordem} {$direcao}";
        }

        $sql = "SELECT * FROM produtos {$ordemSql} LIMIT :limite OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

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

    // Contar total de produtos (para calcular número de páginas)
    public function contarTotal(): int
    {
        $sql = "SELECT COUNT(*) FROM produtos";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }

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
