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

let reservas = [];

function renderizarTabela() {
  tabelaCorpo.innerHTML = "";
  reservas.forEach((reserva, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${reserva.id}</td>
      <td>${reserva.cliente}</td>
      <td>${reserva.servico}</td>
      <td>${reserva.data_entrada}</td>
      <td>${reserva.data_saida || ''}</td>
      <td><span class="status ${reserva.estado.toLowerCase()}">${reserva.estado}</span></td>
      <td>
        <button class="btn edit" data-id="${reserva.id}">Editar</button>
        <button class="btn delete" data-id="${reserva.id}">Eliminar</button>
      </td>
    `;
    tabelaCorpo.appendChild(tr);
  });
}

function atualizarReservasDoDia(data) {
  const reservasDoDia = reservas.filter(r => r.data_entrada === data);
  listaReservas.innerHTML = reservasDoDia.length
    ? reservasDoDia.map(r => `<li>${r.cliente} - ${r.servico}</li>`).join('')
    : '<li>Nenhuma reserva encontrada para esta data.</li>';
}

function carregarReservas() {
  fetch('getReservas.php')
    .then(res => res.json())
    .then(data => {
      reservas = data;
      renderizarTabela();
      if (dataInput.value) {
        atualizarReservasDoDia(dataInput.value);
      }
    })
    .catch(() => {
      alert('Erro ao carregar reservas');
    });
}

dataInput.addEventListener('change', () => {
  if (!dataInput.value) {
    listaReservas.innerHTML = '<li>Selecione uma data.</li>';
    return;
  }
  atualizarReservasDoDia(dataInput.value);
});

tabelaCorpo.addEventListener('click', (e) => {
  const btn = e.target;
  const id = btn.dataset.id;
  if (!id) return;

  if (btn.classList.contains('edit')) {
    const reserva = reservas.find(r => r.id == id);
    if (!reserva) return;

    const novaEntrada = prompt("Nova data de entrada (YYYY-MM-DD):", reserva.data_entrada);
    if (!novaEntrada) return;

    const novaSaida = prompt("Nova data de saída (YYYY-MM-DD):", reserva.data_saida || "");
    if (novaSaida === null) return;

    const novoEstado = prompt("Novo estado (Confirmada, Pendente, Cancelada):", reserva.estado);
    if (!novoEstado) return;

    fetch('editarReserva.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${encodeURIComponent(id)}&data_entrada=${encodeURIComponent(novaEntrada)}&data_saida=${encodeURIComponent(novaSaida)}&estado=${encodeURIComponent(novoEstado)}`
    })
    .then(res => res.json())
    .then(resp => {
      if (resp.sucesso) {
        reserva.data_entrada = novaEntrada;
        reserva.data_saida = novaSaida;
        reserva.estado = novoEstado;
        renderizarTabela();
        if (dataInput.value) atualizarReservasDoDia(dataInput.value);
      } else {
        alert('Erro ao atualizar reserva');
      }
    })
    .catch(() => alert('Erro ao comunicar com o servidor'));
  }

  if (btn.classList.contains('delete')) {
    if (confirm("Tem a certeza que deseja eliminar esta reserva?")) {
      fetch('eliminarReserva.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${encodeURIComponent(id)}`
      })
      .then(res => res.json())
      .then(resp => {
        if (resp.sucesso) {
          reservas = reservas.filter(r => r.id != id);
          renderizarTabela();
          if (dataInput.value) atualizarReservasDoDia(dataInput.value);
        } else {
          alert('Erro ao eliminar reserva');
        }
      })
      .catch(() => alert('Erro ao comunicar com o servidor'));
    }
  }
});

carregarReservas();
