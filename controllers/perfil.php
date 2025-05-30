<?php
session_start();
require_once '../models/conexao.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
  header("Location: login.php");
  exit;
}

$sql = "SELECT nome, email, foto FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id_usuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
  echo "<p style='color: red;'>Usuário não encontrado.</p>";
  exit;
}

$sql_lidos = "SELECT COUNT(*) FROM cadastrodelivros WHERE id_usuario = :id AND status = 'lido'";
$stmt = $conn->prepare($sql_lidos);
$stmt->bindParam(':id', $id_usuario);
$stmt->execute();
$livros_lidos = $stmt->fetchColumn();

$sql_wish = "SELECT COUNT(*) FROM wishlist WHERE id_usuario = :id";
$stmt = $conn->prepare($sql_wish);
$stmt->bindParam(':id', $id_usuario);
$stmt->execute();
$wishlist_total = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
   <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
<div class="container">

  <div class="perfil">

    <h2>Olá, <?= htmlspecialchars($usuario['nome']) ?>!</h2>
    
    <img src="<?= $usuario['foto'] ? $usuario['foto'] : 'img/perfil.png' ?>" alt="Foto de Perfil" class="img-perfil">

    <form action="atualizar_foto.php" method="post" enctype="multipart/form-data" class="form-foto">
    <label for="arquivo" class="custom-file-label">Escolher Imagem</label>
    <input type="file" name="nova_foto" id="arquivo" class="input-foto" accept="image/*" required>
    <span id="nomeArquivo" class="nome-arquivo">Nenhum arquivo escolhido</span>
    <button type="submit" class="botao-foto">Atualizar Foto</button></form>

    <p><strong>Email cadastrado:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
 
    <p><strong>Livros lidos:</strong> <?= $livros_lidos ?></p>
    <p><strong>Na wishlist:</strong> <?= $wishlist_total ?></p>

    <form action="enviar_email_redefinir.php" method="post">
      <input type="hidden" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">

    <a class="registro" href="cadastrar.php">Voltar para Lista de Livros</a>
  </div>
</div>

<script src="../public/js/foto.js"></script>
</body>
</html>
