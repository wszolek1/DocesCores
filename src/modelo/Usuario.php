<?php

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo; // 'adm' ou 'cliente'

    public function __construct(
        int $id,
        string $nome,
        string $email,
        string $senha,
        string $tipo = "cliente"
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo = $tipo;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getSenha() { return $this->senha; }
    public function getTipo() { return $this->tipo; }

    public function isAdmin()
    {
        return $this->tipo === "adm";
    }
}
