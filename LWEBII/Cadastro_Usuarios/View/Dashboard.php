<?php
// No MVC, a sessão geralmente é iniciada no Controller, 
// mas como estamos acessando a View diretamente, precisamos garantir que ela exista.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteção: Se não houver usuário logado, volta para o Login
// Como Dashboard e Login estão na mesma pasta (View), o caminho é direto
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Sistema PHP MVC</span>
            <a href="Logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'): ?>
            <div class="alert alert-primary shadow-sm">
                <strong>Modo Administrador:</strong> Você tem acesso total ao sistema.
            </div>
        <?php endif; ?>

        <div class="jumbotron shadow p-5 bg-white rounded">
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
            <p class="lead">Você está logado com sucesso.</p>
            <hr>
            <p>Seu e-mail registrado é: <strong><?= htmlspecialchars($_SESSION['usuario_email'] ?? 'Não informado') ?></strong></p>
        </div>
    </div>
</body>
</html>