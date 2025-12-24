<?php
require_once '../Config/Conexao.php';
require_once '../Model/Produto.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteção: Se não houver usuário logado, volta para o Login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Login.php");
    exit;
}

$produtoModel = new Produto($pdo);

/** * Ajuste na lógica de listagem: 
 * Agora listamos todos os produtos disponíveis no sistema para que 
 * tanto o admin quanto o usuário comum possam vê-los.
 */
$stmt = $pdo->query("SELECT * FROM produtos");
$meusProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tipo_usuario = $_SESSION['usuario_tipo']; // Identifica se é 'admin' ou 'user'
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Sistema MVC - <?= ucfirst($tipo_usuario) ?></span>
            <div class="d-flex align-items-center">
                <span class="text-light me-3">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
                <a href="Logout.php" class="btn btn-outline-light btn-sm">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> Ação realizada com sucesso!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> Erro: Permissão negada ou estoque insuficiente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if ($tipo_usuario === 'admin'): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Novo Produto</h5>
                        </div>
                        <div class="card-body">
                            <form action="../Controller/ProdutoController.php?acao=cadastrar" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Preço</label>
                                        <input type="number" step="0.01" name="preco" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Estoque</label>
                                        <input type="number" name="estoque" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descrição</label>
                                    <textarea name="descricao" class="form-control" rows="2"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Salvar Produto</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?= $tipo_usuario === 'admin' ? 'col-md-8' : 'col-12' ?>">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-box-seam"></i> Catálogo de Produtos</h5>
                        <span class="badge bg-secondary"><?= count($meusProdutos) ?> itens</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th class="text-center">Qtd.</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($meusProdutos as $produto): ?>
                                        <tr>
                                            <td>
                                                <strong><?= htmlspecialchars($produto['nome']) ?></strong><br>
                                                <small class="text-muted"><?= htmlspecialchars($produto['descricao']) ?></small>
                                            </td>
                                            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $produto['estoque'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                                    <?= (int)$produto['estoque'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($tipo_usuario === 'admin'): ?>
                                                    <a href="../Controller/ProdutoController.php?acao=deletar&id=<?= $produto['id'] ?>" 
                                                       class="btn btn-outline-danger btn-sm" 
                                                       onclick="return confirm('Excluir este produto?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="../Controller/ProdutoController.php?acao=comprar&id=<?= $produto['id'] ?>" 
                                                       class="btn btn-primary btn-sm <?= $produto['estoque'] <= 0 ? 'disabled' : '' ?>">
                                                        <i class="bi bi-cart-plus"></i> Comprar
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>