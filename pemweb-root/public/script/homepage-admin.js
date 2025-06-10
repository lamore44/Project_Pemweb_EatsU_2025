const popup = document.getElementById("popupForm");
const popupTitle = document.getElementById("popupTitle");
const closeBtn = document.getElementById("closePopup");
const form = document.getElementById("dataForm");
const addButtons = document.querySelectorAll(".add-btn");

addButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const type = btn.dataset.type;
    popupTitle.textContent = `Tambah ${type}`;
    form.reset();
    popup.classList.remove("hidden");
  });
});

closeBtn.addEventListener("click", () => {
  popup.classList.add("hidden");
});

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const name = form.name.value;
  const description = form.description.value;
  alert(`Data berhasil ditambahkan:\nNama: ${name}\nDeskripsi: ${description}`);
  popup.classList.add("hidden");
});
