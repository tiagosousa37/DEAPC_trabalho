document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);

  // Pega dados da URL
  const titulo = params.get("titulo") || "Destino não selecionado";
  const idServico = params.get("id_servico") || "";
  const imagem = params.get("imagem") || "";
  const preco = parseFloat(params.get("preco")) || 0;

  // Atualiza destino
  const campoDestino = document.getElementById("campo-destino");
  if (campoDestino) {
    campoDestino.textContent = titulo;
  }

  // Atualiza id_servico (campo hidden)
  const inputIdServico = document.getElementById("id_servico");
  if (inputIdServico) {
    inputIdServico.value = idServico;
  }

  // Atualiza imagem preview
  const imgPreview = document.getElementById("imagem-preview");
  if (imagem && imgPreview) {
    imgPreview.src = imagem;
    imgPreview.style.display = "block";
  }

  // Exibe preço do evento
  const precoEvento = document.getElementById("preco-evento");
  if (precoEvento) {
    precoEvento.textContent = preco > 0 ? `Preço do evento: €${preco.toFixed(2)}` : "";
  }

  // Campo do preço final e input hidden
  const precoFinalText = document.getElementById("preco-final");
  const precoFinalInput = document.getElementById("preco_final_input");

  // Função para atualizar o preço final
  function atualizarPrecoFinal() {
    // Por exemplo, aqui pode multiplicar pelo nº de pessoas se quiser
    const numPessoas = parseInt(document.querySelector('input[name="num_pessoas"]').value) || 1;

    // Exemplo: preço total = preço unitário * nº pessoas
    const total = preco * numPessoas;

    if (precoFinalText) {
      precoFinalText.textContent = `Preço final: €${total.toFixed(2)}`;
    }
    if (precoFinalInput) {
      precoFinalInput.value = total.toFixed(2);
    }
  }

  // Atualiza preço ao carregar
  atualizarPrecoFinal();

  // Atualiza preço ao mudar nº de pessoas
  const inputPessoas = document.querySelector('input[name="num_pessoas"]');
  if (inputPessoas) {
    inputPessoas.addEventListener("input", atualizarPrecoFinal);
  }

  // Opcional: Atualiza preço ao mudar método de pagamento (se quiser alterar preço por método)
  const radiosPagamento = document.querySelectorAll('input[name="pagamento"]');
  radiosPagamento.forEach(radio => {
    radio.addEventListener("change", () => {
      // Se quiser, pode alterar o preço final aqui conforme o método escolhido
      // Por exemplo, sem alteração:
      atualizarPrecoFinal();
    });
  });
});
