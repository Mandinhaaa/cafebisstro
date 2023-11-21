<!doctype html>
<?php
session_start();
if (!isset($_SESSION["NomeUsuario"])) {
    header("Location: login.php");
    exit;
}
require_once("menu.php");

?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>

<body>

    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-ifsp-removebg.png" class="logo" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <?php //require "configuracao.php"; 
        //echo "olá, estou programando em php"; 
        ?>

        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php
                require "conexao.php";
                $sql = "select * from produtos where tipo = 
                'Café' order by preco ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <div class="container-produto">
                            <div class="container-foto">
                                <img src="<?php echo $row['imagem']; ?>">
                            </div>


                            <p><?php echo $row["nome"]; ?></p>
                            <p><?php echo $row["descricao"]; ?></p>
                            <p><?php echo $row["preco"]; ?></p>
                        </div>
                <?php }
                }
                ?>

            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php

                $sql = "select * from produtos where tipo = 'Almoço' 
                order by preco ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="container-produto">
                            <div class="container-foto">
                                <img src="<?= $row['imagem']; ?>">
                            </div>

                            <p><?= $row["nome"]; ?></p>
                            <p style="white-space: normal; word-break: break-all;"><?= $row["descricao"]; ?></p>
                            <p><?= $row["preco"]; ?></p>

                        </div>
                <?php }
                }
                ?>
            </div>

        </section>
    </main>
</body>

</html>