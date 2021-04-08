<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <title>SimpleCRUD - Cadastra Vendas</title>

    <script src="utils.js"></script>
</head>

<body onload="getProdutos()">

    <div class="container">
        <div class="navbar">
            <div class="navbar-brand">
                <h1 class="display-4">Cadastrar Vendas</h1>
            </div>
        </div>
        <hr>

        <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') { ?>

            <div class="row">
                <div class="col">
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sucesso!</strong> A venda foi cadastrado com sucesos.
                    </div>
                </div>
            </div>

        <?php } ?>

        <form id="cadastraVendaForm" action="vendaController.php?acao=gravar" method="post">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="dataVenda">Data da venda:</label>
                        <input class="form-control" id="dataVenda" name="dataVenda" type="date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input class="form-control" id="cep" name="cep" type="text" maxlength="8" placeholder="CEP" onblur="getEndereco(this.value)">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select class="form-control" id="estado" name="estado" type="text">
                            <option value="">-- Estado --</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input class="form-control" id="cidade" name="cidade" type="text" placeholder="Cidade">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input class="form-control" id="endereco" name="endereco" type="text" placeholder="Endereço">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input class="form-control" id="numero" name="numero" type="number" placeholder="Número">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="complemento">Complemento:</label>
                        <input class="form-control" id="complemento" name="complemento" type="text" placeholder="Complemento">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="row">
                        <h4 class="col-5">Todos produtos</h4>
                        <input id="inputPesquisa" class="form-control col-7" type="text" placeholder="Pesquisar produto..." onkeyup="pesquisarProdutos()">
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Fornecedores</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaProdutos">
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <h4>Produtos comprados</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Fornecedores</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaProdutosDaVenda">
                        </tbody>
                    </table>
                    <b>Total:</b>
                    <b id="precoTotal">0</b>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <a class="btn btn-danger btn-lg" type="button" href="index.php">Voltar</a>
                    <button class="btn btn-primary btn-lg" type="submit" onclick="criaInputs()">Cadastrar</button>
                </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>