<?php

$acao = 'recuperar';
require("VendaController.php");

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <title>SimpleCRUD</title>
</head>

<body>

    <div class="container">

        <div class="navbar">
            <div class="navbar-brand">
                <h1 class="display-4">Histórico de Vendas</h1>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col">
                <a class="btn btn-primary btn-lg mb-2" href="cadastra_vendas.php"><i class="fas fa-plus"></i> Nova venda</a>
            </div>
        </div>

        <table class="table">
            <tbody>
                <?php foreach ($vendas as $vendaUnica) {
                    $venda->__set('id', $vendaUnica['referencia']); ?>
                    <tr>
                        <td>
                            <h4>Venda #<?= $vendaUnica['referencia'] ?></h4>
                            <b>Data: <?= $vendaUnica['data'] ?></b><br>
                            <b>CEP: <?= $vendaUnica['cep'] ?></b><br>
                            <b>UF: <?= $vendaUnica['estado'] ?></b><br>
                            <b>Cidade: <?= $vendaUnica['cidade'] ?></b> <br>
                            <b>Endereco: <?= "{$vendaUnica['endereco']}, nº {$vendaUnica['numero']}, {$vendaUnica['complemento']}" ?></b> <br>
                            <b>Produtos:</b><br>
                            <div>
                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produto</th>
                                            <th>Preço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $produtos = $venda->getProdutosVendidos($db);
                                        foreach ($produtos as $produto) {
                                        ?>
                                            <tr>
                                                <td><?= $produto['referencia'] ?></td>
                                                <td><?= $produto['nome'] ?></td>
                                                <td><?= $produto['preco'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <b>Total: <?= $vendaUnica['preco_total'] ?></b> <br>
                            <hr>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>