<?php
session_start();
require_once '../models/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: wishlist.php");
    exit;
}

$sql = "SELECT * FROM wishlist WHERE id = :id AND id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
$wishlist = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$wishlist) {
    header("Location: wishlist.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM wishlist WHERE id = :id AND id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    header("Location: wishlist.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Deletar Livro da Wishlist</title>
  <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container">
  <div class="confirmar">
      <h2>Deletar da Wishlist</h2>
      <p>Tem certeza que deseja deletar o livro <strong><?= htmlspecialchars($wishlist['titulo']) ?></strong> da wishlist?</p>

      <form method="POST">
        <button type="submit" style="background-color: #e74c3c;">🗑️ Deletar</button>
      </form>

      <p style="margin-top: 10px;">
        <a class="registro" href="wishlist.php">Cancelar e voltar</a>
      </p>
    </div>
  </div>
</body>
</html>
