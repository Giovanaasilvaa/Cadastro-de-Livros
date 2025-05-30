<?php
session_start();
require_once '../models/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM wishlist WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$wishlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/css/style.css"/>
  <title>Wishlist</title>
</head>
<body>
<div class="container__cada">

<div class="top-links">
    <a href="create_wishlist.php" class="btn-success">
      <img src="../assets/livrinho.gif" alt="livro gif" class="image"><strong>Adicionar à Wishlist</strong></a>
      
      <a href="cadastrar.php" class="btn-success">
        <img src="../assets/voltar.png" alt="voltar" class="image"><strong>Voltar para Lista de Livros</strong></a>
  </div>

  <h1 class="cada_livro">Minha Wishlist</h1>

  <table class="table_cada">
    <thead>
      <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Ações</th>
      </tr>
    </thead>

    <tbody>
  <?php if (empty($wishlist)): ?>
    <tr>
      <td colspan="3" style="text-align: center;">Sua wishlist está vazia</td>
    </tr>
  <?php else: ?>
    <?php foreach ($wishlist as $livro): ?>
      <tr>
        <td><?= htmlspecialchars($livro['titulo']) ?></td>
        <td><?= htmlspecialchars($livro['autor']) ?></td>
        <td>
          <a href="update_wishlist.php?id=<?= $livro['id'] ?>" class="btn-warning">✏️ Editar</a>
          <a href="delete_wishlist.php?id=<?= $livro['id'] ?>" class="btn-warning">🗑️ Deletar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</tbody>
</table>

</div>
</body>
</html>


