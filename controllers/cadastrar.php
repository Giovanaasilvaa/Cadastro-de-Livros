<?php
session_start();
require_once '../models/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT id, titulo, autor, descricao, status, capa, rating FROM cadastrodelivros WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();

$cadastrodelivros = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['id_livro']) && isset($_POST['rating'])) {
    $id_livro = $_POST['id_livro'];
    $rating = $_POST['rating'];

    $updateSql = "UPDATE cadastrodelivros SET rating = :rating WHERE id = :id_livro";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':rating', $rating);
    $updateStmt->bindParam(':id_livro', $id_livro);
    $updateStmt->execute();
    
    header("Location: ".$_SERVER['PHP_SELF']); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Livros</title>
<link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
<div class="container__cada">
  <div class="top-links">
    <a href="create.php" class="btn-success">
      <img src="../assets/livrinho.gif" alt="livro gif" class="image"><strong>Cadastrar novo livro</strong>  
    </a>
    <a href="wishlist.php" class="btn-success">
      <img src="../assets/wishlist.png" alt="wishlist" class="image"><strong>Minha Wishlist</strong>
    </a>
    <a href="perfil.php" class="btn-success">
      <img src="../assets/perfil.png" alt="perfil" class="image"><strong>Perfil</strong>
    </a>
    <a href="sair.php" class="btn-success">
      <img src="../assets/sair.png" alt="sairdaconta" class="image"><strong>Sair da conta</strong>
    </a>
</div>

<h1 class="cada_livro">Meus Livros</h1>
<p class="cada_info">Passe o mouse sobre um título para ver os detalhes.</p>

<div class="carousel-wrapper">
  <div class="carousel-container">
    <?php foreach ($cadastrodelivros as $livro): ?>
      <div class="item"
        data-titulo="<?= htmlspecialchars($livro['titulo']) ?>"
        data-autor="<?= htmlspecialchars($livro['autor']) ?>"
        data-descricao="<?= htmlspecialchars($livro['descricao']) ?>"
        data-status="<?= $livro['status'] ?>"
        data-id="<?= $livro['id'] ?>">

<?php 
      $capa = htmlspecialchars($livro['capa']);
      $capaPath = (strpos($capa, 'img/capas/') === 0) ? $capa : 'img/capas/' . $capa;

      if (!empty($livro['capa']) && file_exists($capaPath)): ?>
        <img src="<?= $capaPath ?>" alt="Capa do livro" class="capa-livro" />
        <?php else: ?>
        <p class="titulo-livro"><?= htmlspecialchars($livro['titulo']) ?></p>
         <?php endif; ?>

       <form action="" method="POST">
        <input type="hidden" name="id_livro" value="<?= $livro['id'] ?>">
        <div class="rating" data-rating="<?= $livro['rating'] ?>">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <span class="star<?= $i <= $livro['rating'] ? ' filled' : '' ?>" 
          data-value="<?= $i ?>" 
          onclick="submitRating(this, <?= $livro['id'] ?>)">☆</span>
      <?php endfor; ?>
        </div>
        <input type="hidden" name="rating" id="rating_<?= $livro['id'] ?>">
        </form>
        </div>
      <?php endforeach; ?>
  </div>
</div>

<div class="detalhes-livro" id="detalhesLivro"></div>

<script src="../public/js/cada.js"></script>
</body>
</html>
