<?php 

// Inicializando a lista de compras como um array vazio
$listadeCompras = [];

while (true) {
    // Exibe o menu para o usuário
    echo "Escolha uma opção:\n";
    echo "1. Adicionar item\n";
    echo "2. Remover item\n";
    echo "3. Listar itens\n";
    echo "4. Consultar quantidade\n";
    echo "5. Sair\n";
    echo "Digite sua opção: ";
    
    $opcao = trim(fgets(STDIN)); // Lê a opção do usuário
    
    switch ($opcao) {
        case 1:
            // Adicionar item
            echo "Digite o nome do item: ";
            $item = trim(fgets(STDIN));
            array_push($listadeCompras, $item); // Adiciona o item à lista
            echo "Item adicionado à lista!\n";
            break;
        
        case 2:
            // Remover item
            if (count($listadeCompras) > 0) {
                $removido = array_pop($listadeCompras); // Remove o último item da lista
                echo "Item '$removido' removido da lista!\n";
            } else {
                echo "A lista está vazia, não há itens para remover.\n";
            }
            break;
        
        case 3:
            // Listar itens
            if (count($listadeCompras) > 0) {
                echo "Lista de Compras:\n";
                foreach ($listadeCompras as $item) {
                    echo "- $item\n";
                }
            } else {
                echo "A lista de compras está vazia.\n";
            }
            break;
        
        case 4:
            // Consultar quantidade
            $quantidade = count($listadeCompras); // Conta o número de itens na lista
            echo "Quantidade de itens na lista: $quantidade\n";
            break;
        
        case 5:
            // Sair
            echo "Saindo... Até logo!\n";
            exit; // Encerra o programa
        
        default:
            // Opção inválida
            echo "Opção inválida! Tente novamente.\n";
            break;
    }
}

?>
