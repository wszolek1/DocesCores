<?php

class UsuarioRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar por ID (muito útil para login e painel)
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

    // Buscar por email (login)
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

    // Listar todos (somente administradores costumam usar isso)
    public function listarTodos(): array
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
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

    // Contar quantos usuários existem
    public function contarTotal(): int
    {
        $sql = "SELECT COUNT(*) FROM usuarios";
        return (int) $this->pdo->query($sql)->fetchColumn();
    }
}
