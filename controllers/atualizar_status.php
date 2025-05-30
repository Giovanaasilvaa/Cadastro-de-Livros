<?php
session_start();
require_once '../models/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_livro'], $_POST['status_atual'])) {
    $id_livro = $_POST['id_livro'];
    $status_atual = $_POST['status_atual'];

    $novo_status = ($status_atual === 'lido') ? 'nao lido' : 'lido';

    $sql = "UPDATE cadastrodelivros SET status = :novo_status WHERE id = :id_livro";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':novo_status', $novo_status);
    $stmt->bindParam(':id_livro', $id_livro);
    $stmt->execute();
}

header("Location: cadastrar.php");
exit;
