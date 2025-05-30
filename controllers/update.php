<?php
require_once '../models/conexao.php';


$id_livro = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM cadastrodelivros WHERE id = :id_livro");
$stmt->bindParam(':id_livro', $id_livro);
$stmt->execute();
$cadastrodelivros = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cadastrodelivros) {
    echo "<p>Livro não encontrado.</p>";
    exit;
}

$titulo = $cadastrodelivros['titulo'];
$autor = $cadastrodelivros['autor'];
$descricao = $cadastrodelivros['descricao'];
$capa = $cadastrodelivros['capa'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $descricao = $_POST['descricao'];

  if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] === 0) {
    $foto = $_FILES['nova_foto'];
    $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $novo_nome_capa = 'capa_' . $id_livro . '.' . $extensao; 
    $caminho = 'img/' . $novo_nome_capa;

    if (move_uploaded_file($foto['tmp_name'], $caminho)) {
      $sql = "UPDATE cadastrodelivros SET titulo = :titulo, autor = :autor, descricao = :descricao, capa = :capa WHERE id = :id_livro";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id_livro', $id_livro);
      $stmt->bindParam(':titulo', $titulo);
      $stmt->bindParam(':autor', $autor); 
      $stmt->bindParam(':descricao', $descricao);
      $stmt->bindParam(':capa', $caminho); 
      $stmt->execute();

      header("Location: ../index.php"); 
      exit;
    } else {
      echo "<p style='color:red;'>Erro ao mover a imagem.</p>";
  }
 } else {
      $sql = "UPDATE cadastrodelivros SET titulo = :titulo, autor = :autor, descricao = :descricao WHERE id = :id_livro";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id_livro', $id_livro);
      $stmt->bindParam(':titulo', $titulo);
      $stmt->bindParam(':autor', $autor); 
      $stmt->bindParam(':descricao', $descricao);
      $stmt->execute();

      header("Location: ../index.php"); 
      exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container-update">
    <div class="login-box">
      <h2>Editar Livro</h2>
      <form method="POST" enctype="multipart/form-data">
        <label for="titulo">Título do Livro:</label>
        <div class="input-box">
          <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($titulo) ?>" required>
        </div>

        <label for="autor">Autor:</label>
        <div class="input-box">
          <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($autor) ?>" required>
        </div>

        <label for="descricao">Descrição:</label>
        <div class="input-box">
          <input type="text" name="descricao" id="descricao" value="<?= htmlspecialchars($descricao) ?>" required>
        </div>

        <label for="capa">Capa:</label>
        <input type="file" name="nova_foto" id="arquivo" accept="image/*">
        <span id="nomeArquivo">
        <?= $capa ? basename($capa) : 'Nenhuma capa selecionada' ?></span>

        <button type="submit">Salvar Alterações</button>

        <p style="margin-top: 10px;"><a class="registro" href="cadastrar.php">Voltar para lista</a></p>
    </div>
  </div>
</body>
<script src="../public/js/update.js"></script>
</html>
