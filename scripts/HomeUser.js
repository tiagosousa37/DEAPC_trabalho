document.addEventListener("DOMContentLoaded", function () {
    const filtroForm = document.querySelector(".filtros-form");
    const tendenciasSection = document.getElementById("tendenciasContainer");

    function atualizarTendencias(servicos) {
        tendenciasSection.innerHTML = "";

        if (servicos.length === 0) {
            tendenciasSection.innerHTML = "<p>Nenhum resultado encontrado.</p>";
            return;
        }

        servicos.forEach(servico => {
            const card = document.createElement("div");
            card.className = "card";

            // Usa imagem ou uma padrão
            const imagem = servico.imagem && servico.imagem !== "" ? servico.imagem : "images/default.jpg";

            // Criar conteúdo HTML do card
            card.innerHTML = `
                <img src="${imagem}" alt="${servico.titulo || 'Serviço'}" style="width:100%; border-radius:5px;">
                <span>
                    ${servico.titulo || "Sem título"}<br>
                    <small>${servico.data || "Data não definida"}</small>
                </span>
            `;

            // Evento para redirecionar ao clicar no card
            card.addEventListener("click", () => {
                const params = new URLSearchParams({
                    titulo: servico.titulo || "",
                    data: servico.data || "",
                    imagem: imagem
                });
                window.location.href = `ReservasUser.html?${params.toString()}`;
            });

            tendenciasSection.appendChild(card);
        });
    }

    filtroForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const tipo = document.getElementById("tipo").value;
        const continente = document.getElementById("continente").value;
        const data = document.getElementById("data").value;

        // Monta os parâmetros para a URL
        const params = new URLSearchParams();
        if (tipo) params.append("tipo", tipo);
        if (continente) params.append("continente", continente);
        if (data) params.append("data", data);

        // Faz a requisição para HomeUser.php
        fetch(`scripts/HomeUser.php?${params.toString()}`)
            .then(response => {
                if (!response.ok) throw new Error("Erro na resposta do servidor.");
                return response.json();
            })
            .then(data => atualizarTendencias(data))
            .catch(error => {
                console.error("Erro ao carregar dados:", error);
                tendenciasSection.innerHTML = "<p>Erro ao carregar serviços.</p>";
            });
    });
});

