getProdutos = () => {

    let xhttp = new XMLHttpRequest()

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            let produtos = JSON.parse(xhttp.responseText)


            produtos.forEach(produto => {

                let tr = document.createElement('tr')
                tr.id = produto['referencia']

                let td1 = document.createElement('td')
                let td2 = document.createElement('td')
                let td3 = document.createElement('td')
                let td4 = document.createElement('td')
                let td5 = document.createElement('td')

                let buttonGroup = document.createElement('div')

                let buttonAdd = document.createElement('button')
                buttonAdd.className = 'btn btn-primary'
                buttonAdd.innerHTML = '<i class="fas fa-plus"></i>'
                buttonAdd.type = 'button'
                buttonAdd.addEventListener('click', () => {
                    adicionaProduto(tr)
                })

                let buttonRmv = document.createElement('button')
                buttonRmv.className = 'btn btn-danger'
                buttonRmv.innerHTML = '<i class="fas fa-times"></i>'
                buttonRmv.type = 'button'
                buttonRmv.style.display = 'none'
                buttonRmv.addEventListener('click', () => {
                    removeProduto(tr)
                })

                buttonGroup.appendChild(buttonAdd)
                buttonGroup.appendChild(buttonRmv)

                td1.innerHTML = produto['referencia']
                td2.innerHTML = produto['nome_produto']
                td3.innerHTML = produto['preco']
                td4.innerHTML = produto['nome_fornecedor']
                td5.appendChild(buttonGroup)

                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)
                tr.appendChild(td4)
                tr.appendChild(td5)

                document.getElementById('tabelaProdutos').appendChild(tr)

            })

        }
    }

    xhttp.open('get', 'VendaController.php?acao=recuperarProdutos')
    xhttp.send()

}

adicionaProduto = (tr) => {

    tr.childNodes[4].childNodes[0].childNodes[0].style.display = 'none'
    tr.childNodes[4].childNodes[0].childNodes[1].style.display = ''

    document.getElementById('tabelaProdutosDaVenda').append(tr)

    document.getElementById('precoTotal').innerHTML = parseFloat(document.getElementById('precoTotal').innerHTML) + parseFloat(tr.childNodes[2].innerHTML)

}

removeProduto = (tr) => {

    tr.childNodes[4].childNodes[0].childNodes[1].style.display = 'none'
    tr.childNodes[4].childNodes[0].childNodes[0].style.display = ''


    document.getElementById('tabelaProdutos').appendChild(tr)

    document.getElementById('precoTotal').innerHTML = parseFloat(document.getElementById('precoTotal').innerHTML) - parseFloat(tr.childNodes[2].innerHTML)
}

validaCampos = () => {

    $valido = true;

    if (isNaN(parseInt(document.getElementById('cep').value)) || document.getElementById('estado').value == ''
        || document.getElementById('cidade').value == '' || document.getElementById('endereco').value == '' || document.getElementById('numero').value == ''
    ) {
        $valido = false;
    }

    return $valido
}

criaInputs = () => {

    if (validaCampos()) {

        var linhasAdicionadas = [...document.getElementById('tabelaProdutosDaVenda').children]

        linhasAdicionadas.forEach(linha => {

            let input = document.createElement('input')

            input.type = 'hidden'
            input.name = `produto${linha.id}`
            input.value = linha.children[2].innerHTML

            document.getElementById('cadastraVendaForm').appendChild(input)

        })
    } else {

        alert("Preencha todos os campos do endereço corretamente!")
        event.preventDefault();
    }

}

getEndereco = (cep) => {

    let xhttp = new XMLHttpRequest()
    let endereco

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            endereco = JSON.parse(xhttp.responseText)

            if (!endereco.erro) {
                document.getElementById('estado').value = endereco.uf
                document.getElementById('cidade').value = endereco.localidade
                document.getElementById('endereco').value = endereco.logradouro + ', ' + endereco.bairro
            }

        }
    }

    xhttp.open('get', `http://viacep.com.br/ws/${cep}/json`)
    xhttp.send()
}

pesquisarProdutos = () => {
    let input, filter, table, tr
    input = document.getElementById('inputPesquisa')
    filter = input.value.toUpperCase()
    table = document.getElementById('tabelaProdutos').parentElement
    tr = table.getElementsByTagName('tr')

    for (let i = 0; i < tr.length; i++) {

        referencia = tr[i].getElementsByTagName('td')[0]
        nome = tr[i].getElementsByTagName('td')[1]

        if (referencia && nome) {

            referenciaValue = referencia.textContent || referencia.innerText
            nomeValue = nome.textContent || nome.innerText

            if (referenciaValue.toUpperCase().indexOf(filter) > -1 || nomeValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = ''
            } else {
                tr[i].style.display = 'none'
            }
        }
    }
}