<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="col-md-4 mx-auto">
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">Usuário ou senha inválidos!</div> <?php endif; ?>

        <?php if (isset($_COOKIE['ultimo_usuario'])): ?>
            <p class="text-muted">Último usuário logado: <?php echo $_COOKIE['ultimo_usuario']; ?></p> <?php endif; ?>

        <form action="valida.php" method="POST" class="card p-4 shadow"> <h2 class="text-center">Login</h2>
            <div class="mb-3">
                <label>Usuário</label>
                <input type="text" name="usuario" class="form-control" required> </div>
            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required> </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>
</html>