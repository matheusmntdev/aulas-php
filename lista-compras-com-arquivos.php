<?php 
 
$listadeCompras = []; 

function adicionarItem($item) {
    global $listadeCompras;
    array_push($listadeCompras, $item);

    $arrayConvertido = serialize($listadeCompras);

    $arquivoSalvo = file_put_contents("lista-de-compras.txt", $arrayConvertido);

    if ($arquivoSalvo === false) {
        echo "Falha ao salvar o item na lista!\n";
        return;
    } else { 
        echo "Item adicionado à lista!\n";
    }
}

function removerItem() {
    $arquivo = file_get_contents("lista-de-compras.txt");

    $arrayListaDeCompras = unserialize($arquivo); 

    if ($arrayListaDeCompras === false) {
        echo "Erro ao converter a lista de compras";
        return;
    }  

    if (count($arrayListaDeCompras) == 0) {
        echo "A lista está vazia, não há itens para remover.\n";
        return;
    }
    
    $item = array_pop($arrayListaDeCompras);

    $arquivoSalvo = file_put_contents("lista-de-compras.txt", serialize($arrayListaDeCompras)); 

    if ($arquivoSalvo === false) {
        echo "Falha ao remover $item da lista!\n";
        return;
    } else {
        echo "$item removido da lista!\n";
    }
}

function listarItens() {
    $arquivo = file_get_contents("lista-de-compras.txt");

    $arrayListaDeCompras = unserialize($arquivo);

    if ($arrayListaDeCompras === false) {
        echo "Erro ao converter a lista de compras!\n";
        return;
    }

    if (count($arrayListaDeCompras) == 0) {
        echo "A lista está vazia!\n";
        return;
    }

    echo "Lista de compras:\n";
    echo "-----------------\n";
    foreach ($arrayListaDeCompras as $item) {
        echo '- ' . ucfirst($item) . PHP_EOL;
    }
    echo "-----------------\n";
    echo "\n";
}

while (true) { 
    echo "Escolha uma opção:\n";
    echo "1. Adicionar item\n";
    echo "2. Remover item\n";
    echo "3. Listar itens\n";
    echo "4. Consultar quantidade\n";
    echo "5. Sair\n"; 
    
    $opcao = readline("Digite sua opção: ");

    if ($opcao == 0 || $opcao > 5) {
        echo "Opção inválida! Tente novamente.\n";
    }

    if ($opcao == 1) { 
        $item = readline("Digite o nome do item: ");
        adicionarItem($item);
    } 

    if ($opcao == 2) {
        removerItem(); 
    }

    if ($opcao == 3){
        listarItens();
    }

    if ($opcao == 4) {
        $quantidade = count($listadeCompras); 
        echo "Quantidade de itens na lista: $quantidade\n";
    }

    if ($opcao == 5) {
        echo "Saindo... Até logo!\n";
        exit;
    } 
}

?>
