<?php

require ("Connection.php");



$db = Connection::getDb();

$query = "create table vendas(referencia int not null primary key auto_increment,
            data date,
            cep char(8) not null,
            estado varchar(30) not null,
            cidade varchar(30) not null,
            endereco varchar(200) not null,
            numero varchar(10) not null,
            complemento varchar(20),
            preco_total double not null
)";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "create table fornecedores(referencia int not null primary key auto_increment,
            nome varchar(100) not null
)";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "create table produtos(referencia int not null primary key auto_increment,
            nome varchar(100) not null,
            preco double not null
)";
$stmt = $db->prepare($query);
$stmt->execute();

$query = "create table vendas_produtos( venda_id int not null, 
produto_id int not null, 
foreign key (venda_id) references vendas(referencia), 
foreign key (produto_id) references produtos(referencia) )";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "create table produtos_fornecedores( produto_id int not null, 
fornecedor_id int, 
foreign key (produto_id) references produtos(referencia), 
foreign key (fornecedor_id) references fornecedores(referencia) )";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into fornecedores(nome) values ('Forn A')";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into fornecedores(nome) values ('Forn B')";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into fornecedores(nome) values ('Forn D')";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos(nome, preco) values ('Prod A', 2.50)";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos(nome, preco) values ('Prod B', 10.00)";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos(nome, preco) values ('Prod C', 5.00)";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos_fornecedores(produto_id, fornecedor_id) values ( 1 , 1)";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos_fornecedores(produto_id, fornecedor_id) values ( 1 , 2)";

$stmt = $db->prepare($query);
$stmt->execute();

$query = "insert into produtos_fornecedores(produto_id, fornecedor_id) values ( 3 , 3)";

$stmt = $db->prepare($query);
$stmt->execute();







