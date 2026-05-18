const municipios = {
  RO: ["Porto Velho", "Ji-Paraná", "Ariquemes", "Cacoal"],

  AM: ["Manaus", "Parintins", "Itacoatiara"],

  AC: ["Rio Branco", "Cruzeiro do Sul"],
};

const estado = document.getElementById("estado");
const municipio = document.getElementById("municipio");

estado.addEventListener("change", function () {
  const uf = this.value;

  municipio.innerHTML = "";

  municipio.disabled = false;

  municipios[uf].forEach(function (cidade) {
    municipio.innerHTML += `
            <option value="${cidade}">
                ${cidade}
            </option>
        `;
  });
});
