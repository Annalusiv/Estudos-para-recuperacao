<?php
// Sobe um nível para sair de Controller e entrar em Model ou Config
require_once '../Model/Usuario.php';
require_once '../Config/Conexao.php'; // Verifique se o 'C' é maiúsculo conforme o nome da pasta
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $erros = [];

    if (empty($email) || empty($senha)) {
        $erros[] = "Preencha todos os campos.";
    } else {
        // O $pdo vem do arquivo Conexao.php incluído acima
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo']; // Importante para o Admin!
            
            // Redireciona para a View que está em outro diretório
            header("Location: ../View/Dashboard.php");
            exit;
        } else {
            $erros[] = "Email ou senha incorretos.";
        }
    }

    // Caso falhe, volta para o formulário de login
    $_SESSION['erros_login'] = $erros;
    $_SESSION['dados_login'] = ['email' => $email];
    header("Location: ../View/Login.php");
    exit;
}