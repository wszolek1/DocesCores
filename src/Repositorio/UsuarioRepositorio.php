<?php

class UsuarioRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar por ID
    public function buscarPorId(int $id): ?Usuario
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Usuario(
            $row['id'],
            $row['nome'],
            $row['email'],
            $row['senha'],
            $row['tipo']
        );
    }

    // Buscar por email
    public function buscarPorEmail(string $email): ?Usuario
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Usuario(
            $row['id'],
            $row['nome'],
            $row['email'],
            $row['senha'],
            $row['tipo']
        );
    }

    // NOVO → listar com ordenação
    public function listarOrdenado(?string $ordem, string $direcao): array
    {
        $campos = ['id', 'nome', 'email', 'tipo'];

        if (!in_array($ordem, $campos)) {
            $ordem = 'nome';
        }

        $direcao = strtoupper($direcao) === 'DESC' ? 'DESC' : 'ASC';

        $sql = "SELECT * FROM usuarios ORDER BY {$ordem} {$direcao}";
        $stmt = $this->pdo->query($sql);

        $usuarios = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario(
                $row['id'],
                $row['nome'],
                $row['email'],
                $row['senha'],
                $row['tipo']
            );
        }

        return $usuarios;
    }

    // Contar usuários
    public function contarTotal(): int
    {
        $sql = "SELECT COUNT(*) FROM usuarios";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
