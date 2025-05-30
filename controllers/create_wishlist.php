<?php
session_start();
require_once '../models/conexao.php';


if (!isset($_SESSION['id_usuario'])) {
  header("Location: index.php");
  exit;
}

$id_usuario = $_SESSION['id_usuario'];

$titulo = $autor = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $id_usuario = $_SESSION['id_usuario'];

  $sql = "INSERT INTO wishlist (titulo, autor, id_usuario) VALUES (:titulo, :autor, :id_usuario)";
  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':titulo', $titulo);
  $stmt->bindParam(':autor', $autor);
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
<title>Adicionar à Wishlist</title>
<link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
<div class="container">
  <div class="login-box">
    <h2>Adicionar Livro à Wishlist</h2>

    <form method="POST" action="">
      <label for="titulo">Título do Livro:</label>
      <div class="input-box">
        <input type="text" name="titulo" placeholder="Ex: O Senhor dos Anéis" required>
      </div>

      <label for="autor">Autor do Livro:</label>
      <div class="input-box">
        <input type="text" name="autor" placeholder="Ex: J.R.R. Tolkien" required>
      </div>

      <br>
      <button type="submit">Salvar Livro</button>
    </form>

    <p style="margin-top: 10px;">
    <a class="registro" href="wishlist.php">Voltar para a Wishlist</a>
    </p>
  </div>
</div>
</body>
</html>
