class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorEmail($email) {
    $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
    }

    public function salvar($nome, $email, $senha, $tipo) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha_hash,
            'tipo'  => $tipo
        ]);
    }
}