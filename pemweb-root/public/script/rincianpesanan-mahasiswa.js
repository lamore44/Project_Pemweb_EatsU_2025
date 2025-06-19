document.addEventListener("DOMContentLoaded", () => {
  const payBtn = document.getElementById("payBtn");
  const modal = document.getElementById("paymentModal");

  payBtn.addEventListener("click", () => {
    modal.style.display = "flex";
  });

  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
});
