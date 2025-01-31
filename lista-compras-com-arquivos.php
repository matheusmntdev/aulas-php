<?php
function handleFile()
{
    $arquivo = file_get_contents("lista-compras.txt");

    $arrayListaDeCompras = unserialize($arquivo);

    if ($arrayListaDeCompras === false) {
        return "Erro ao converter a lista de compras ou seu arquivo está vazio. \n \n";
    }

    if (count($arrayListaDeCompras) == 0) {
        return "A lista está vazia. \n \n";
    }

    return $arrayListaDeCompras;
}

function adicionarItem($item)
{
    $arrayListaDeCompras = [];

    if (file_exists("lista-compras.txt")) {
        $arrayListaDeCompras = unserialize(file_get_contents("lista-compras.txt"));
    } 

    $arrayListaDeCompras[] = $item;

    $arrayConvertido = serialize($arrayListaDeCompras);

    $conteudo = file_put_contents("lista-compras.txt", $arrayConvertido);

    if ($conteudo == false) {
        return "Erro ao adicionar item no arquivo \n \n";
    }

    return "Item '$item' adicionado com sucesso! \n \n";
}

function removerItem($indiceParaRemover)
{
    $resultado = handleFile();

    if (is_array($resultado)) {
        if (!key_exists($indiceParaRemover, $resultado)) {
            return "Escolha um item que está na sua lista para poder remover. \n \n";
        }

        $itemRemovido = ucfirst($resultado[$indiceParaRemover]);

        unset($resultado[$indiceParaRemover]);

        $arrayOrganizado = array_values($resultado);

        $arquivoSalvo = file_put_contents("lista-compras.txt", serialize($arrayOrganizado));

        if ($arquivoSalvo === false) {
            return "Falha ao remover $itemRemovido da lista!\n \n";
        }

        return "$itemRemovido removido da lista!\n \n";
    } else {
        echo $resultado;
    }
}

function listarItens()
{
    $resultado = handleFile();

    echo "Sua lista de compras contém: \n \n";
    if (is_array($resultado)) {
        foreach ($resultado as $indice => $item) {
            echo $indice . ' - ' . $item . PHP_EOL;
        }
        echo "-----------------------------\n";
    } else {
        echo $resultado;
    }
}

function exibirQuantidade()
{
    $resultado = handleFile();

    if (is_array($resultado)) {
        echo count($resultado) . " itens na sua lista" . PHP_EOL;
        listarItens();
    } else {
        echo $resultado;
    }
}

while (true) {
    echo "Escolha uma opção:\n";
    echo "1. Adicionar item\n";
    echo "2. Remover item\n";
    echo "3. Listar itens\n";
    echo "4. Consultar quantidade\n";
    echo "5. Sair\n";

    $opcao = readline("Digite uma opção: ");

    echo PHP_EOL;
    echo '------------------------------';
    echo PHP_EOL;

    if ($opcao == 0 || $opcao > 5) {
        echo "Opção inválida, digite alguma do menu. \n";
    }

    if ($opcao == 1) {
        $item = readline("Digite o nome do item: ");
        $mensagem = adicionarItem($item);

        echo $mensagem;
    }

    if ($opcao == 2) {
        listarItens();
        $itemParaRemover = readline("Digite o numero do item a ser removido: ");
        $mensagem = removerItem($itemParaRemover);

        echo $mensagem;
    }

    if ($opcao == 3) {
        listarItens();
    }

    if ($opcao == 4) {
        exibirQuantidade();
    }

    if ($opcao == 5) {
        exit;
    }
}
