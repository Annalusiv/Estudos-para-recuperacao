<?php
session_start();

$usuario_valido = "user_test"; 
$senha_valida = "123";         

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario === $usuario_valido && $senha === $senha_valida) {
        $_SESSION['usuario'] = $usuario;
        
        // Criar cookie com duração de 1 hora 
        setcookie("ultimo_usuario", $usuario, time() + 3600, "/"); 
        
        header("Location: home.php");
        exit;
    } else {
        header("Location: login.php?erro=1"); 
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}