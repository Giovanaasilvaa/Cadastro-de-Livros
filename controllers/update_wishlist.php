<?php
require_once '../models/conexao.php';

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM wishlist WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$wishlist = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$wishlist) {
  echo "<p>Livro não encontrado.</p>";
  exit;
}

$titulo = $wishlist['titulo'];
$autor = $wishlist['autor'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];

    $sql = "UPDATE wishlist SET titulo = :titulo, autor = :autor WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->execute();

    header("Location: wishlist.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Editar Wishlist</title>
  <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Editar Livro da Wishlist</h2>
      <form method="POST">
        <label for="titulo">Título:</label>
        <div class="input-box">
          <input type="text" name="titulo" value="<?= htmlspecialchars($titulo) ?>" required>
        </div>

        <label for="autor">Autor:</label>
        <div class="input-box">
          <input type="text" name="autor" value="<?= htmlspecialchars($autor) ?>" required>
        </div>

        <button type="submit">Salvar Alterações</button>
      </form>
      <p style="margin-top: 10px;"><a class="registro" href="wishlist.php">Voltar para a Wishlist</a></p>
    </div>
  </div>
</body>
</html>
