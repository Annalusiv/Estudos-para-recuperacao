<?php
require_once '../Config/Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $tipo = isset($_POST['is_admin']) ? 'admin' : 'user';

    $erros = [];

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $erros[] = "Todos os campos são obrigatórios.";
    }
    if (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }
    if ($senha !== $confirmar_senha) {
        $erros[] = "As senhas não coincidem.";
    }

    if (empty($erros)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
            $stmt->execute(["email" => $email]);
            
            if ($stmt->rowCount() > 0) {
                $erros[] = "Este email já está cadastrado.";
            }
        } catch (PDOException $e) {
            $erros[] = "Erro ao verificar email: " . $e->getMessage();
        }
    }

    if (empty($erros)) {
        try {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha_hash,
                'tipo'  => $tipo
            ]);
            header("Location: ../View/Login.php?cadastro=sucesso");
            exit;
        } catch (PDOException $e) {
            $erros[] = "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }

   if (!empty($erros)) {
        session_start();
        $_SESSION['erros_cadastro'] = $erros;
        $_SESSION['dados_cadastro'] = ['nome' => $nome, 'email' => $email];
        // 3. Ajuste o redirecionamento de erro (voltar para a View de Cadastro)
        header("Location: ../View/Cadastro.php");
        exit;
    }
}
?>