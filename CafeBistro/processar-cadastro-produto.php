<?php
require_once "conexao.php";
// Obter os dados do formulário
$tipo = $_POST["tipo"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];

if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
    $uploadDir = "img/"; // Diretório de destino
    $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);
    $imagem = $uploadFile;


    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, imagem, preco) VALUES 
        ('$tipo', '$nome', '$descricao', '$imagem', '$preco')";
    
        if ($conn->query($sql) === TRUE) {
            header("Location: cadastrar-produto-sucesso.php");
            exit();
        } else {
            header("Location: cadastrar-produto.php?erro=2");
            exit();
        }
        $conn->close();
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
} else {
    echo "Erro: " . $_FILES["imagem"]["error"];
}
