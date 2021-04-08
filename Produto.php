<?php

class Produto
{
    public function getProdutos($db)
    {
        $db = Connection::getDb();

        $query = "select p.referencia, p.nome as nome_produto, p.preco, group_concat(f.nome separator ', ') as nome_fornecedor from produtos as p left join produtos_fornecedores as pf on p.referencia = pf.produto_id left join fornecedores as f on f.referencia = pf.fornecedor_id group by p.referencia";
        $stmt = $db->prepare($query);
        $stmt->execute();

        header("Content-type: application/json");

        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
