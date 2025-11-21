<?php

class Produto
{
    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private ?string $imagem;

    public function __construct(
        int $id,
        string $nome,
        string $descricao,
        float $preco,
        ?string $imagem = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;

        // Se não tiver imagem, usa padrão
        $this->imagem = $imagem ?: "upload/padrao.png";
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getDescricao() { return $this->descricao; }
    public function getPreco() { return $this->preco; }

    // Agora retorna exatamente o caminho salvo no banco
    public function getImagemDiretorio()
    {
        return $this->imagem;
    }

    public function getPrecoFormatado()
    {
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }
}
