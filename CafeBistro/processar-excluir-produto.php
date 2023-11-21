<?php
require_once "conexao.php";
// Obter os dados do formulário
$nome = $_GET["nome"];
$tipo = $_GET["tipo"];
$descricao = $_GET["descricao"];
$preco = $_GET["preco"];
$id = $_GET["id"];


    $sql = "DELETE FROM PRODUTOS WHERE 
    id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: excluir-produto-sucesso.php");
        exit();
    } else {
        header("Location: excluir-produto.php?erro=2");
        exit();
    }
    $conn->close();
