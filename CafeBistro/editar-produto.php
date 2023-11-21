<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/logo-ifsp-removebg.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

  <title>Serenatto - Editar Produto</title>
</head>

<body>
<form action="admin.php" method="post" style= "margin-left:0;">
                <input type="submit" name="voltar" class="botao-cadastrar" value="voltar" style="display: block; margin-left: auto; margin-right: auto;" />
            </form>
  <main>
    <section class="container-admin-banner">
      <img src="img/logo-ifsp-removebg.png" class="logo-admin" alt="logo-serenatto">
      <h1>Editar Produto</h1>
      <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
      <?php
      require "conexao.php";
      $id = $_GET['id'];
      $sql = "select * from produtos where id = '$id'";
      $result = $conn->query($sql);

      $row = $result->fetch_assoc();

      ?>

      <form method="POST" onsubmit="editarProduto();" id="editarForm">

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="<?php echo $row['nome']; ?>" value="<?php echo $row['nome']; ?>" required>

        <div class="container-radio">
          <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" <?php if ($row['tipo'] == "Café") {
                                                                      echo 'checked';
                                                                    } ?>>
          </div>
          <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço" <?php if ($row['tipo'] == "Almoço") {
                                                                          echo 'checked';
                                                                        } ?>>
          </div>
        </div>

        <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" placeholder="<?php echo $row['descricao']; ?>" value="<?php echo $row['descricao']; ?>" required>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" placeholder="<?php echo $row['preco']; ?>" value="<?php echo $row['preco']; ?>" required>
        <?php $imagemfake = $row['imagem'];
               

        // Remove a parte "C:\fakepath\" do valor (apenas no caso de navegadores baseados em Windows)
        $imagem = basename($imagemfake);

        // Agora, $imagem conterá apenas o nome do arquivo, sem a parte "C:\fakepath\"
        ?>
        <label for="imagem">Envie uma nova imagem do produto ou mantenha a imagem atual: 
          <div class="container-foto">
            <img src="<?= $row['imagem']; ?>" alt="<?php echo $imagem; ?>" width="200">
          </div><?php echo $imagem; ?></label>
        <input type="file" name="imagem" accept="image/*" id="imagem" value="<?php echo $imagem;?>">

        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">

        <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto" />
      </form>

    </section>
  </main>

  <script>
    

    function editarProduto() {
      event.preventDefault(); // Impede o envio padrão do formulário
      // Pega o valor do campo de arquivo
      const fileInput = document.getElementById("imagem");
      const filePath = fileInput.value;

      // Remove a parte "C:\fakepath\" do valor
      const fileName = filePath.replace("C:\\fakepath\\", "");

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
          const url = `processar-editar-produto.php?nome=${nome}&tipo=${tipo}&descricao=${descricao}&preco=${preco}&id=${id}&imagem=${fileName}`;
          window.location.href = url;
        } else if (result.isDenied) {
          Swal.fire("Edição cancelada", "", "info");
        }
      });

      // Impede o envio do formulário
      return false;
    }
  </script>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>