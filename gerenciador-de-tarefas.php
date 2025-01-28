<?php

// Inicializando o array de tarefas
$tarefas = [];

function adicionarTarefa(&$tarefas)
{
  // Solicita as informações da tarefa
  echo "Digite o nome da tarefa: ";
  $nome = trim(fgets(STDIN));

  // Verifica se a tarefa já existe
  foreach ($tarefas as $tarefa) {
    if ($tarefa['nome'] == $nome) {
      echo "Já existe uma tarefa com esse nome!\n";
      return;
    }
  }

  echo "Digite a prioridade (alta, média, baixa): ";
  $prioridade = trim(fgets(STDIN));

  // Adiciona a tarefa ao array
  $tarefas[] = [
    'nome' => $nome,
    'prioridade' => $prioridade
  ];

  echo "Tarefa adicionada com sucesso!\n";
}

function removerTarefa(&$tarefas)
{
  // Solicita o nome da tarefa a ser removida
  echo "Digite o nome da tarefa a ser removida: ";
  $nome = trim(fgets(STDIN));

  // Busca a tarefa pelo nome
  foreach ($tarefas as $index => $tarefa) {
    if ($tarefa['nome'] == $nome) {
      // Pergunta ao usuário se tem certeza da remoção
      echo "Tem certeza que deseja remover a tarefa '{$tarefa['nome']}'? (s/n): ";
      $confirmacao = trim(fgets(STDIN));

      if ($confirmacao == 's') {
        unset($tarefas[$index]);
        $tarefas = array_values($tarefas); // Reorganiza os índices do array
        echo "Tarefa removida com sucesso!\n";
      } else {
        echo "Remoção cancelada.\n";
      }
      return;
    }
  }

  echo "Tarefa não encontrada.\n";
}

function listarTarefas($tarefas)
{
  if (count($tarefas) > 0) {
    echo "Lista de Tarefas:\n";
    foreach ($tarefas as $index => $tarefa) {
      echo ($index + 1) . ". {$tarefa['nome']} - Prioridade: {$tarefa['prioridade']}\n";
    }
  } else {
    echo "Não há tarefas cadastradas.\n";
  }
}

function listarPorPrioridade($tarefas)
{
  // Solicita a prioridade
  echo "Digite a prioridade (alta, média, baixa): ";
  $prioridade = trim(fgets(STDIN));

  $tarefasFiltradas = array_filter($tarefas, function ($tarefa) use ($prioridade) {
    return $tarefa['prioridade'] == $prioridade;
  });

  if (count($tarefasFiltradas) > 0) {
    echo "Tarefas com prioridade '$prioridade':\n";
    foreach ($tarefasFiltradas as $index => $tarefa) {
      echo ($index + 1) . ". {$tarefa['nome']} - Prioridade: {$tarefa['prioridade']}\n";
    }
  } else {
    echo "Não há tarefas com a prioridade '$prioridade'.\n";
  }
}

function exibirMenu()
{
  echo "\nEscolha uma opção:\n";
  echo "1. Adicionar tarefa\n";
  echo "2. Remover tarefa\n";
  echo "3. Listar todas as tarefas\n";
  echo "4. Listar tarefas por prioridade\n";
  echo "5. Sair\n";
  echo "Digite sua opção: ";
}

while (true) {
  // Exibe o menu e recebe a opção
  exibirMenu();
  $opcao = trim(fgets(STDIN));

  switch ($opcao) {
    case 1:
      // Adicionar tarefa
      adicionarTarefa($tarefas);
      break;

    case 2:
      // Remover tarefa
      removerTarefa($tarefas);
      break;

    case 3:
      // Listar todas as tarefas
      listarTarefas($tarefas);
      break;

    case 4:
      // Listar tarefas por prioridade
      listarPorPrioridade($tarefas);
      break;

    case 5:
      // Sair do programa
      echo "Saindo... Até logo!\n";
      exit;

    default:
      // Opção inválida
      echo "Opção inválida! Tente novamente.\n";
      break;
  }
}
