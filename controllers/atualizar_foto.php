<?php
session_start();
require_once '../models/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['nova_foto'])) {
    $foto = $_FILES['nova_foto'];


    if ($foto['error'] === 0) {
        $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $nome_arquivo = 'perfil_' . $id_usuario . '.' . $extensao;
        $caminho = 'img/' . $nome_arquivo;


        if (move_uploaded_file($foto['tmp_name'], $caminho)) {
            $sql = "UPDATE usuarios SET foto = :foto WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':foto', $caminho);
            $stmt->bindParam(':id', $id_usuario);
            $stmt->execute();

            header("Location: perfil.php");
            exit;
        } else {
            echo "<p style='color:red;'>Erro ao mover a imagem.</p>";
        }
    } else {
        echo "<p style='color:red;'>Erro no upload da imagem.</p>";
    }
} else {
    echo "<p style='color:red;'>Nenhuma imagem enviada.</p>";
}
?>
