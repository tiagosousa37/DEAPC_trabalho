document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);

  const titulo = params.get("titulo") || "Destino não selecionado";
  const idServico = params.get("id_servico") || "";
  const imagem = params.get("imagem") || "";
  const preco = parseFloat(params.get("preco")) || 0;

  const campoDestino = document.getElementById("campo-destino");
  if (campoDestino) {
    campoDestino.textContent = titulo;
  }

  const inputIdServico = document.getElementById("id_servico");
  if (inputIdServico) {
    inputIdServico.value = idServico;
  }

  const imgPreview = document.getElementById("imagem-preview");
  if (imagem && imgPreview) {
    imgPreview.src = imagem;
    imgPreview.style.display = "block";
  }

  const precoEvento = document.getElementById("preco-evento");
  if (precoEvento) {
    precoEvento.textContent = preco > 0 ? `Preço do evento: €${preco.toFixed(2)}` : "";
  }

  const precoFinalText = document.getElementById("preco-final");
  const precoFinalInput = document.getElementById("preco_final_input");

  function atualizarPrecoFinal() {
    const numPessoas = parseInt(document.querySelector('input[name="num_pessoas"]').value) || 1;

    const total = preco * numPessoas;

    if (precoFinalText) {
      precoFinalText.textContent = `Preço final: €${total.toFixed(2)}`;
    }
    if (precoFinalInput) {
      precoFinalInput.value = total.toFixed(2);
    }
  }

  atualizarPrecoFinal();

  const inputPessoas = document.querySelector('input[name="num_pessoas"]');
  if (inputPessoas) {
    inputPessoas.addEventListener("input", atualizarPrecoFinal);
  }

  const radiosPagamento = document.querySelectorAll('input[name="pagamento"]');
  radiosPagamento.forEach(radio => {
    radio.addEventListener("change", () => {
      atualizarPrecoFinal();
    });
  });
});
const dataInput = document.querySelector('#dataSelecionada');
  const listaReservas = document.querySelector('#listaReservas');
  const tabelaCorpo = document.querySelector('tbody');

  let reservas = [
    { id: "#001", cliente: "Ana Silva", servico: "Hotel Praia Sol", entrada: "2025-04-05", saida: "2025-04-10", estado: "Confirmada" },
    { id: "#002", cliente: "Ricardo Jorge", servico: "Voo Porto → Zurique", entrada: "2025-03-20", saida: "", estado: "Pendente" },
    { id: "#003", cliente: "Diana Costa", servico: "Concerto Bad Bunny", entrada: "2026-05-26", saida: "2026-05-26", estado: "Cancelada" }
  ];

  function renderizarTabela() {
    tabelaCorpo.innerHTML = "";
    reservas.forEach((reserva, index) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${reserva.id}</td>
        <td>${reserva.cliente}</td>
        <td>${reserva.servico}</td>
        <td>${reserva.entrada}</td>
        <td>${reserva.saida}</td>
        <td><span class="status ${reserva.estado.toLowerCase()}">${reserva.estado}</span></td>
        <td>
          <button class="btn edit" data-index="${index}">Editar</button>
          <button class="btn delete" data-index="${index}">Eliminar</button>
        </td>
      `;
      tabelaCorpo.appendChild(tr);
    });
  }

  function atualizarReservasDoDia(data) {
    const reservasDoDia = reservas.filter(r => r.entrada === data);
    listaReservas.innerHTML = reservasDoDia.length
      ? reservasDoDia.map(r => `<li>${r.cliente} - ${r.servico}</li>`).join('')
      : '<li>Nenhuma reserva encontrada para esta data.</li>';
  }

  dataInput?.addEventListener('change', () => {
    const dataSelecionada = dataInput.value;
    if (!dataSelecionada) {
      listaReservas.innerHTML = '<li>Selecione uma data.</li>';
      return;
    }
    atualizarReservasDoDia(dataSelecionada);
  });

  tabelaCorpo.addEventListener('click', (e) => {
    const index = e.target.dataset.index;
    if (e.target.classList.contains('edit')) {
      const novaDataEntrada = prompt("Nova data de entrada (YYYY-MM-DD):", reservas[index].entrada);
      if (novaDataEntrada) reservas[index].entrada = novaDataEntrada;

      const novaDataSaida = prompt("Nova data de saída (YYYY-MM-DD):", reservas[index].saida);
      if (novaDataSaida) reservas[index].saida = novaDataSaida;

      const novoEstado = prompt("Novo estado (Confirmada, Pendente, Cancelada):", reservas[index].estado);
      if (novoEstado) reservas[index].estado = novoEstado;

      renderizarTabela();
      if (dataInput.value) atualizarReservasDoDia(dataInput.value);
    }

    if (e.target.classList.contains('delete')) {
      if (confirm("Tem a certeza que deseja eliminar esta reserva?")) {
        reservas.splice(index, 1);
        renderizarTabela();
        if (dataInput.value) atualizarReservasDoDia(dataInput.value);
      }
    }
  });

  renderizarTabela();
});
