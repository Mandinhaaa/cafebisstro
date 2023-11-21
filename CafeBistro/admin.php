<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-ifsp2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>IFSP - Admin</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-ifsp-removebg.png" class="logo-admin" alt="logo-IFSP">
    <h1>Admistração IFSP Café Bistrô</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <h2>Lista de Produtos</h2>

  <section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>
      <?php
      require "conexao.php";
      $sql = "select * from produtos order by tipo, preco ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>

      <tbody>
      <tr>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['tipo'] ?></td>
        <td><?= $row['descricao'] ?></td>
        <td><?= 'R$'. $row['preco'] ?></td>
       
        <td>
        <form action="editar-produto.php" method="GET"> 
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <input type="submit" class="botao-editar" value="Editar">
          </form>
        </td>
        <td>
          <form action="excluir-produto.php" method="GET">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="submit" class="botao-excluir" value="Excluir">
          </form>
        </td>
        
      </tr>
      <?php }
                }
                ?>
      </tbody>
    </table>
  <a class="botao-cadastrar" href="cadastrar-produto.php">Cadastrar produto</a>
  <form action="#" method="post">
    <input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>
  </form>
  </section>
  <script>
    function excluirProduto() {
      event.preventDefault(); // Impede o envio padrão do formulário

      const nome = document.getElementById("nome").value;
      const tipo = document.querySelector('input[name="tipo"]:checked').value;
      const descricao = document.getElementById("descricao").value;
      const preco = document.getElementById("preco").value;
      const imagem = document.getElementById("imagem").value;
      const id = document.getElementById("id").value;

      Swal.fire({
        title: "Confirme a edição do produto",
        html: `<strong>Nome:</strong> ${nome}<br>
           <strong>Tipo:</strong> ${tipo}<br>
           <strong>Descrição:</strong> ${descricao}<br>
           <strong>Preço:</strong> ${preco}<br>
           <strong>Imagem:</strong> ${fileName}<br>`,
        showDenyButton: true,
        
        confirmButtonText: "Editar",
        denyButtonText: "Cancelar",

      }).then((result) => {
        if (result.isConfirmed) {
          // Se o usuário confirmar a edição, redirecione para outra página
          const url = `excluir-produto-sucesso.php?id=${id}`;
          window.location.href = url;
        } else if (result.isDenied) {
          Swal.fire("Edição cancelada", "", "info");
        }
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</main>
</body>
</html>