<?php
session_start();
require_once '../models/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.php");
  exit;
}

$id_usuario = $_SESSION['id_usuario'];

$titulo = $autor = $descricao = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $descricao = $_POST['descricao'];
  $status = $_POST['status'] ?? 'pendente';
  $genero = $_POST['genero'] ?? null;
  $ano = $_POST['ano_publicacao'] ?? null;
  $preco = $_POST['preco'] ?? null;
  $caminhoCapa = null;


  if (!empty($_FILES['capa']['name'])) {
    $nomeArquivo = basename($_FILES['capa']['name']);
    $caminhoFinal = 'img/capas/' . $nomeArquivo;

  
    if (!is_dir('img/capas')) {
      mkdir('img/capas', 0755, true);
    }

    if (move_uploaded_file($_FILES['capa']['tmp_name'], $caminhoFinal)) {
      $caminhoCapa = $nomeArquivo;
    }
  }

  $sql = "INSERT INTO cadastrodelivros (id_usuario, titulo, autor, descricao, status, capa)
          VALUES (:id_usuario, :titulo, :autor, :descricao, :status, :capa)";

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':id_usuario' => $id_usuario,
    ':titulo' => $titulo,
    ':autor' => $autor,
    ':descricao' => $descricao,
    ':status' => $status,
    ':capa' => $caminhoCapa
  ]);

  header("Location: cadastrar.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Adicionar Livro</title>
  <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container-create">
    <div class="login-box">
      <h2>Adicionar Novo Livro</h2>

      <form method="POST" action="" enctype="multipart/form-data">
        <label for="titulo">Título do Livro:</label>
        <div class="input-box">
          <input type="text" name="titulo" placeholder="Ex: O Senhor dos Anéis" required>
        </div>

        <label for="autor">Autor do Livro:</label>
        <div class="input-box">
          <input type="text" name="autor" placeholder="Ex: J.R.R. Tolkien" required>
        </div>

        <label for="descricao">Descrição:</label>
        <div class="input-box">
          <textarea name="descricao" rows="4" placeholder="Escreva uma breve descrição..." required></textarea>
        </div>

        <label for="status">Status do Livro:</label>
        <div class="input-box">
          <select name="status" required>
            <option value="pendente">Pendente</option>
            <option value="lido">Lido</option>
          </select>
        </div>

        <label for="capa">Capa do Livro:</label>
        <div class="input-box">
          <input type="file" name="capa" accept="image/*">
        </div>

        <button type="submit">Salvar Livro</button>
      </form>

      <p style="margin-top: 10px;">
        <a class="registro" href="cadastrar.php">Voltar para a lista de livros</a>
      </p>
    </div>
  </div>
</body>
</html>
