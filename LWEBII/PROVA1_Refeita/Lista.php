<?php
session_start();
if (!isset($_SESSION['usuario'])) header("Location: login.php");
include 'dados_produto.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Produtos</h2>
    <table class="table table-striped"> <thead>
            <tr><th>Nome</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['produtos'] as $index => $p): ?>
                <tr>
                    <td><?php echo $p['nome']; ?></td>
                    <td>
                        <a href="detalhe.php?i=<?php echo $index; ?>" class="btn btn-sm btn-info">Ver Detalhe</a> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="home.php" class="btn btn-secondary">Voltar</a>
</body>
</html>