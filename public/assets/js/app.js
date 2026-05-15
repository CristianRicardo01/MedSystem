// SIDEBAR MOBILE

const toggleSidebar = document.getElementById("toggleSidebar");
const sidebar = document.getElementById("sidebar");

toggleSidebar.addEventListener("click", () => {
  sidebar.classList.toggle("active");
});

// LOADER

window.addEventListener("load", () => {
  const loader = document.getElementById("globalLoader");

  setTimeout(() => {
    loader.classList.add("hide");
  }, 500);
});

// TOAST

function showToast(message = "Operação realizada!") {
  const toastEl = document.getElementById("liveToast");

  toastEl.querySelector(".toast-body").innerText = message;

  const toast = new bootstrap.Toast(toastEl);

  toast.show();
}
