<?php
session_start();

// Se o usuário já estiver logado, redireciona para a dashboard
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

$email = isset($_SESSION['dados_login']['email']) ? $_SESSION['dados_login']['email'] : '';
$erros = isset($_SESSION['erros_login']) ? $_SESSION['erros_login'] : [];
$sucesso = isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso';

unset($_SESSION['erros_login'], $_SESSION['dados_login']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 col-md-4">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4 text-secondary">Login</h2>

            <?php if ($sucesso): ?>
                <div class="alert alert-success">Cadastro realizado! Faça login.</div>
            <?php endif; ?>

            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($erros as $erro) echo "<li>$erro</li>"; ?>
                </div>
            <?php endif; ?>

            <form action="../Controller/processa_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
                <p class="mt-3 text-center">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
            </form>
        </div>
    </div>
</body>
</html>