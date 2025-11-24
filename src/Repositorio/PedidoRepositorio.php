<?php

class PedidoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Listar todos os pedidos (para o ADM)
    public function listarTodos(): array
    {
        $sql = "SELECT * FROM pedidos ORDER BY data_pedido DESC";
        $stmt = $this->pdo->query($sql);

        $pedidos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pedidos[] = new Pedido(
                $row['id'],
                $row['usuario_id'],
                $row['nome_cliente'],
                $row['produto'],
                (int) $row['quantidade'],
                $row['status'],
                $row['data_pedido']
            );
        }

        return $pedidos;
    }

    // Buscar pedidos por usuário
    public function buscarPorUsuario(int $usuarioId): array
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :id ORDER BY data_pedido DESC";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();

        $pedidos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pedidos[] = new Pedido(
                $row['id'],
                $row['usuario_id'],
                $row['nome_cliente'],
                $row['produto'],
                (int) $row['quantidade'],
                $row['status'],
                $row['data_pedido']
            );
        }

        return $pedidos;
    }

    // Contar pedidos
    public function contarTotal(): int
    {
        $sql = "SELECT COUNT(*) FROM pedidos";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
