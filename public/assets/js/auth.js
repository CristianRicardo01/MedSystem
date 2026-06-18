console.log("CARREGANDO FILTRO SENHA");

const passwordInput = document.getElementById("password");

const passwordConfirmation = document.getElementById("password_confirmation");

if (passwordInput) {
  passwordInput.addEventListener("input", function () {
    const password = this.value;

    updateRule("length", password.length >= 8);

    updateRule("uppercase", /[A-Z]/.test(password));

    updateRule("special", /[\W_]/.test(password));

    updateStrength(password);

    validateMatch();
  });
}

if (passwordConfirmation) {
  passwordConfirmation.addEventListener("input", validateMatch);
}

function updateRule(elementId, valid) {
  const element = document.getElementById(elementId);

  if (!element) return;

  if (valid) {
    element.classList.remove("text-danger");

    element.classList.add("text-success");
  } else {
    element.classList.remove("text-success");

    element.classList.add("text-danger");
  }
}

function updateStrength(password) {
  let score = 0;

  if (password.length >= 8) score++;

  if (/[A-Z]/.test(password)) score++;

  if (/[a-z]/.test(password)) score++;

  if (/[0-9]/.test(password)) score++;

  if (/[\W_]/.test(password)) score++;

  const bar = document.getElementById("passwordStrength");

  const text = document.getElementById("passwordStrengthText");

  if (!bar || !text) return;

  switch (score) {
    case 1:
    case 2:
      bar.style.width = "25%";

      bar.className = "progress-bar bg-danger";

      text.innerText = "Senha Fraca";

      break;

    case 3:
      bar.style.width = "50%";

      bar.className = "progress-bar bg-warning";

      text.innerText = "Senha Média";

      break;

    case 4:
      bar.style.width = "75%";

      bar.className = "progress-bar bg-info";

      text.innerText = "Senha Boa";

      break;

    case 5:
      bar.style.width = "100%";

      bar.className = "progress-bar bg-success";

      text.innerText = "Senha Forte";

      break;

    default:
      bar.style.width = "0%";

      bar.className = "progress-bar";

      text.innerText = "Digite uma senha";
  }
}

function validateMatch() {
  const message = document.getElementById("passwordMatch");

  if (!message) return;

  const password = passwordInput.value;

  const confirmation = passwordConfirmation.value;

  if (confirmation.length === 0) {
    message.innerHTML = "";

    return;
  }

  if (password === confirmation) {
    message.className = "small mt-2 text-success";

    message.innerHTML =
      '<i class="bi bi-check-circle-fill me-1"></i>As senhas coincidem';
  } else {
    message.className = "small mt-2 text-danger";

    message.innerHTML =
      '<i class="bi bi-x-circle-fill me-1"></i>As senhas não coincidem';
  }
}
