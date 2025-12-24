<?php
session_start();

// Proteção da página: se não houver ID na sessão, volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
    <div class="alert alert-info">Painel de Controle: Você tem privilégios de Administrador.</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Sistema PHP</span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="jumbotron shadow p-5 bg-white rounded">
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
            <p class="lead">Você está logado na área administrativa.</p>
        </div>
    </div>
</body>
</html>