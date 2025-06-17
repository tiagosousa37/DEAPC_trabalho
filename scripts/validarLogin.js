document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    let valid = true;

    // Limpar estilos antigos
    [email, password].forEach((el) => {
      el.style.border = "";
      el.style.backgroundColor = "";
    });

    if (email.value.trim() === "" || !email.value.includes("@")) {
      email.style.border = "2px solid red";
      email.style.backgroundColor = "#ffe5e5";
      valid = false;
    }

    if (password.value.trim() === "") {
      password.style.border = "2px solid red";
      password.style.backgroundColor = "#ffe5e5";
      valid = false;
    }

    if (!valid) {
      event.preventDefault();
    }
  });
});

