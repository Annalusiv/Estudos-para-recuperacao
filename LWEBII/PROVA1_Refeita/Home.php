<?php
// 1. Inicia a sessão para ter acesso aos dados do usuário
session_start();

// 2. Proteção da página: verifica se a variável 'usuario' existe na sessão
// Se não existir, o aluno não fez login e deve ser expulso para a index 
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// 3. Recupera o nome do usuário para exibir na tela 
$nome_usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Bem-vindo, <?php echo htmlspecialchars($nome_usuario);?></span> 
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h1>Olá, <?php echo htmlspecialchars($nome_usuario);?>!</h1> 
                
                <div class="d-grid gap-2 d-md-block mt-4">
                    <a href="lista.php" class="btn btn-primary">Ver Lista de Produtos</a> 
                    <a href="logout.php" class="btn btn-danger">Sair do Sistema</a> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>