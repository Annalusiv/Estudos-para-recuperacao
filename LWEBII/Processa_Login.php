<?php
require_once 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $erros = [];

    if (empty($email) || empty($senha)) {
        $erros[] = "Preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            header("Location: dashboard.php");
            exit;
        } else {
            $erros[] = "Email ou senha incorretos.";
        }
    }

    $_SESSION['erros_login'] = $erros;
    $_SESSION['dados_login'] = ['email' => $email];
    header("Location: login.php");
    exit;
}