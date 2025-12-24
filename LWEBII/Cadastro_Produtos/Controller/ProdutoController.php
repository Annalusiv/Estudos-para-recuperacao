<?php
require_once '../Config/Conexao.php';
require_once '../Model/Produto.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../View/Login.php");
    exit;
}

$produtoModel = new Produto($pdo);
$acao = $_GET['acao'] ?? '';
$tipo_usuario = $_SESSION['usuario_tipo'];

// CADASTRO: Só Admin
if ($acao === 'cadastrar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($tipo_usuario !== 'admin') {
        header("Location: ../View/Dashboard.php?erro=permissao_negada");
        exit;
    }
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $usuario_id = $_SESSION['usuario_id'];

    if ($produtoModel->salvar($nome, $descricao, $preco, $estoque, $usuario_id)) {
        header("Location: ../View/Dashboard.php?sucesso=produto_salvo");
    }
}

// ELIMINAR: Só Admin
if ($acao === 'deletar') {
    if ($tipo_usuario !== 'admin') {
        header("Location: ../View/Dashboard.php?erro=permissao_negada");
        exit;
    }
    $id = $_GET['id'];
    $produtoModel->deletar($id, $_SESSION['usuario_id']);
    header("Location: ../View/Dashboard.php?sucesso=produto_removido");
}

// COMPRAR: Só Utilizador Comum
if ($acao === 'comprar') {
    if ($tipo_usuario !== 'user') {
        header("Location: ../View/Dashboard.php?erro=admin_nao_compra");
        exit;
    }
    $id = $_GET['id'];
    if ($produtoModel->reduzirEstoque($id)) {
        header("Location: ../View/Dashboard.php?sucesso=compra_concluida");
    } else {
        header("Location: ../View/Dashboard.php?erro=sem_stock");
    }
}