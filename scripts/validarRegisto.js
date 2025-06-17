document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    const nome = document.getElementById("nome");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    let valid = true;

    // Limpar estilos antigos
    [nome, email, password].forEach((el) => {
      el.style.border = "";
      el.style.backgroundColor = "";
    });

    // Verificar campos obrigatórios
    if (nome.value.trim() === "") {
      nome.style.border = "2px solid red";
      nome.style.backgroundColor = "#ffe5e5";
      valid = false;
    }

    if (email.value.trim() === "" || !email.value.includes("@")) {
      email.style.border = "2px solid red";
      email.style.backgroundColor = "#ffe5e5";
      valid = false;
    }

    if (password.value.length < 6) {
      password.style.border = "2px solid red";
      password.style.backgroundColor = "#ffe5e5";
      alert("A palavra-passe deve ter pelo menos 6 caracteres.");
      valid = false;
    }

    if (!valid) {
      event.preventDefault(); // Impede envio do formulário
    }
  });
});

