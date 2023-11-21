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

  <title>Serenatto - Excluir Produto</title>
</head>

<body>
<form action="admin.php" method="post" style= "margin-left:0;">
                <input type="submit" name="voltar" class="botao-cadastrar" value="voltar" style="display: block; margin-left: auto; margin-right: auto;" />
            </form>
  <main>
    <section class="container-admin-banner">
      <img src="img/logo-ifsp-removebg.png" class="logo-admin" alt="logo-serenatto">
      <h1>Excluir Produto</h1>
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

      <form method="POST" onsubmit="excluirProduto();" id="editarForm">

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="<?php echo $row['nome']; ?>" value="<?php echo $row['nome']; ?>" readonly="readonly">

        <div class="container-radio">
          <div>
            <label for="cafe">Café</label>
            <input type="radio" id="cafe" name="tipo" value="Café" onclick="return false;"<?php if ($row['tipo'] == "Café") {
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
        <input type="text" id="descricao" name="descricao" placeholder="<?php echo $row['descricao']; ?>" value="<?php echo $row['descricao']; ?>" readonly="readonly">

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" placeholder="<?php echo $row['preco']; ?>" value="<?php echo $row['preco']; ?>" readonly="readonly">
        

        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">

        <input type="submit" name="editar" class="botao-cadastrar" value="Excluir produto" />
      </form>
    </section>
    <div>
            </div>
  </main>
                                                                        
  <script>
    

    function excluirProduto() {
      event.preventDefault(); // Impede o envio padrão do formulário

      const nome = document.getElementById("nome").value;
      const tipo = document.querySelector('input[name="tipo"]:checked').value;
      const descricao = document.getElementById("descricao").value;
      const preco = document.getElementById("preco").value;
      const id = document.getElementById("id").value;

      Swal.fire({
        title: "Confirme a exclusão do produto",
        html: `<strong>Nome:</strong> ${nome}<br>
           <strong>Tipo:</strong> ${tipo}<br>
           <strong>Descrição:</strong> ${descricao}<br>
           <strong>Preço:</strong> ${preco}<br>`,
        showDenyButton: true,
        
        confirmButtonText: "Excluir",
        denyButtonText: "Cancelar",

      }).then((result) => {
        if (result.isConfirmed) {
          // Se o usuário confirmar a edição, redirecione para outra página
          const url = `processar-excluir-produto.php?nome=${nome}&tipo=${tipo}&descricao=${descricao}&preco=${preco}&id=${id}`;
          window.location.href = url;
        } else if (result.isDenied) {
          Swal.fire("Exclusão cancelada", "", "info");
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