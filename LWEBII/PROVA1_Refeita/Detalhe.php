<?php
session_start();
if (!isset($_SESSION['usuario'])) header("Location: login.php"); 

$id = $_GET['i'] ?? null; 
$produto = $_SESSION['produtos'][$id] ?? null;

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Detalhe do Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card p-4">
        <h3><?php echo $produto['nome']; ?></h3> <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p> <a href="lista.php" class="btn btn-primary">Voltar para Lista</a> </div>
</body>
</html>