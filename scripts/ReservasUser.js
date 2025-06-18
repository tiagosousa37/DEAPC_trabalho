document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);

  const destino = params.get("destino");
  const data = params.get("data");
  const imagem = params.get("imagem");

  console.log("Destino recebido:", destino); 

  if (destino) {
    const campoDestino = document.getElementById("campo-destino");
    if (campoDestino) {
      campoDestino.textContent = destino;
    }

    let campoLocal = document.getElementById("campo-local");
    if (!campoLocal) {
      campoLocal = document.createElement("input");
      campoLocal.type = "hidden";
      campoLocal.name = "local";
      campoLocal.id = "campo-local";
      const form = document.querySelector("form");
      if (form) {
        form.appendChild(campoLocal);
      }
    }
    campoLocal.value = destino;
  }

  if (data) {
    const inputData = document.getElementById("campo-data");
    if (inputData) inputData.value = data;
  }

  if (imagem) {
    const imgPreview = document.getElementById("imagem-preview");
    if (imgPreview) {
      imgPreview.src = imagem;
      imgPreview.style.display = "block";
    }
  }
});

