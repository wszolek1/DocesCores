<?php

class Pedido
{
    private int $id;
    private int $usuarioId;
    private string $nomeCliente;
    private string $produto;
    private int $quantidade;
    private string $status;
    private string $dataPedido;

    public function __construct(
        int $id,
        int $usuarioId,
        string $nomeCliente,
        string $produto,
        int $quantidade,
        string $status = "Pendente",
        string $dataPedido = ""
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->nomeCliente = $nomeCliente;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->status = $status;

        // Se vier vazio, deixa o valor do banco
        $this->dataPedido = $dataPedido ?: date("Y-m-d H:i:s");
    }

    public function getId() { return $this->id; }
    public function getUsuarioId() { return $this->usuarioId; }
    public function getNomeCliente() { return $this->nomeCliente; }
    public function getProduto() { return $this->produto; }
    public function getQuantidade() { return $this->quantidade; }
    public function getStatus() { return $this->status; }
    public function getDataPedido() { return $this->dataPedido; }

    public function getStatusFormatado()
    {
        return ucfirst(strtolower($this->status));
    }
}
