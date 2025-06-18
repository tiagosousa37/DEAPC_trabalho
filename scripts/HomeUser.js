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

            const imagem = servico.imagem && servico.imagem !== "" ? servico.imagem : "images/default.jpg";

            card.innerHTML = `
                <img src="${imagem}" alt="${servico.titulo || 'Serviço'}" style="width:100%; border-radius:5px;">
                <span>
                    ${servico.titulo || "Sem título"}<br>
                    <small>${servico.data || "Data não definida"}</small>
                </span>
            `;

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

        const params = new URLSearchParams();
        if (tipo) params.append("tipo", tipo);
        if (continente) params.append("continente", continente);
        if (data) params.append("data", data);

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

