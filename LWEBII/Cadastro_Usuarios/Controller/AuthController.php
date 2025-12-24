require_once 'Config/Conexao.php';
require_once 'Model/Usuario.php';
//classe que realiza as funções separando ainda mais o view do model
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];
            
            $model = new Usuario($GLOBALS['pdo']);
            $usuario = $model->buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: dashboard.php");
            } else {
                // Lógica de erro do seu Login.php
            }
        }
    }
    public function cadastrar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $tipo = isset($_POST['is_admin']) ? 'admin' : 'user';
        
        
        // Chamada ao Model para salvar
        $usuarioModel = new Usuario($this->pdo);
        $sucesso = $usuarioModel->salvar($nome, $email, $_POST['senha'], $tipo);

        if ($sucesso) {
            header("Location: login.php?cadastro=sucesso");
            exit;
        }
    }
}
}