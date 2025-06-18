document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);

  const titulo = params.get("titulo");
  const data = params.get("data");
  const imagem = params.get("imagem");

  if (titulo) {
    document.getElementById("campo-destino").textContent = titulo;
    document.getElementById("campo-local").value = titulo;
  }

  if (data) document.getElementById("campo-data").value = data;

  if (imagem) {
    const imgPreview = document.getElementById("imagem-preview");
    if (imgPreview) {
      imgPreview.src = imagem;
      imgPreview.style.display = "block";
    }
  }
});
