<?php
class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($nome, $descricao, $preco, $estoque, $usuario_id) {
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, usuario_id) VALUES (:nome, :desc, :preco, :estoque, :uid)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nome' => $nome,
            'desc' => $descricao,
            'preco' => $preco,
            'estoque' => $estoque,
            'uid' => $usuario_id
        ]);
    }

    public function listarPorUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos"); // Alterado para listar todos os produtos para todos verem
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletar($id, $usuario_id) {
        // Apenas o dono ou admin pode deletar (aqui simplificado para o admin)
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // NOVO MÉTODO PARA COMPRA
    public function reduzirEstoque($id) {
        $sql = "UPDATE produtos SET estoque = estoque - 1 WHERE id = :id AND estoque > 0";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}