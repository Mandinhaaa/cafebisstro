// JavaScript para controlar o modal
$(document).ready(function () {
    const form = document.getElementById('editarProdutoForm');
    const submitButton = document.querySelector('input[type="submit"]');

    // Quando o formulário for submetido
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            // Se o formulário não for válido, não faça nada
            return;
        }

        event.preventDefault(); // Impede o envio do formulário padrão

        // Adicione aqui a lógica de envio do formulário (por exemplo, usando AJAX para processar a edição do produto)

        // Após a edição bem-sucedida do produto, exibir o modal
        $("#successModal").show();
    });

    // Fechar o modal quando o botão "X" for clicado
    $("#closeModal").click(function () {
        $("#successModal").hide();
    });
});
