<?php

require("Connection.php");
require("Produto.php");
require("Venda.php");


$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'recuperar') {
    $db = Connection::getDb();
    $venda = new Venda();
    $vendas = $venda->getVendas($db);
}
if ($acao == 'recuperarProdutos') {

    $db = Connection::getDb();
    $produto = new Produto();

    $produtos = $produto->getProdutos($db);

    echo $produtos;
}
if ($acao == 'gravar') {

    $db = Connection::getDb();
    $venda = new Venda;
    $produto = new Produto;    
    $produtos = array_slice($_POST, 7);    

    $venda->__set('data', $_POST['dataVenda'])->__set('cep', $_POST['cep'])->__set('estado', $_POST['estado'])->__set('cidade', $_POST['cidade'])->__set('endereco', $_POST['endereco'])->__set('numero', $_POST['numero'])->__set('complemento', $_POST['complemento'])->__set('produtos', $produtos);
      
    $precoTotal = 0;    

    foreach($produtos as $precoProduto){
        $precoTotal += $precoProduto;
    }

    $venda->__set('precoTotal', $precoTotal);

    $venda->cadastraVenda($db);

    header('Location: cadastra_vendas.php?cadastro=sucesso');
    
}
