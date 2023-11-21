<?php
require_once "conexao.php";
// Obter os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$confirmarsenha = $_POST["confirmarsenha"];

if ($senha === $confirmarsenha) {
    // Inserir os dados na tabela 'usuario'
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES 
    ('$nome', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        header("Location: cadastrar-usuario-sucesso.php");
        exit();
    } else {
        header("Location: cadastrar-usuario.php?erro=2");
        exit();
    }
    $conn->close();
}else{
    header("Location: cadastrar-usuario.php?erro=1");
    exit();
}
