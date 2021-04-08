<?php

class Venda
{

    private $id = null;
    private $data = null;
    private $cep = null;
    private $estado = null;
    private $cidade = null;
    private $endereco = null;
    private $numero = null;
    private $complemento = null;
    private $precoTotal = null;
    private $produtos = null;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
        return $this;
    }

    public function getVendas($db)
    {
        $query = 'select referencia,data, cep, estado, cidade, endereco, numero, complemento, preco_total from vendas';
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutosVendidos($db)
    {

        $query = 'select p.referencia, p.nome, p.preco from produtos as p join vendas_produtos as vp on p.referencia = vp.produto_id where venda_id = :venda_id';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':venda_id', $this->id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastraVenda($db)
    {
        $query = 'insert into vendas (data, cep, estado, cidade, endereco, numero, complemento, preco_total) values (:data, :cep, :estado, :cidade, :endereco, :numero, :complemento, :preco_total)';
        $stmt = $db->prepare($query);
        if ($this->data == null)
            $stmt->bindValue(':data', null);
        else
            $stmt->bindValue(':data', $this->data);
        $stmt->bindValue(':cep', $this->cep);
        $stmt->bindValue(':estado', $this->estado);
        $stmt->bindValue(':cidade', $this->cidade);
        $stmt->bindValue(':endereco', $this->endereco);
        $stmt->bindValue(':numero', $this->numero);
        $stmt->bindValue(':complemento', $this->complemento);
        $stmt->bindValue(':preco_total', $this->precoTotal);
        $stmt->execute();

        $lastId = $db->lastInsertId();

        foreach ($this->produtos as $indice => $produto) {
            $query = 'insert into vendas_produtos (venda_id, produto_id) values (:venda_id, :produto_id)';
            $stmt = $db->prepare($query);
            $stmt->bindValue(':venda_id', $lastId);
            $stmt->bindValue(':produto_id', str_replace('produto', '', $indice));
            $stmt->execute();
        }
    }
}
