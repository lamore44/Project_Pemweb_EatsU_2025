document.addEventListener("DOMContentLoaded", () => {
  // Ambil semua kontrol kuantitas
  const quantityControls = document.querySelectorAll(".qty-control");

  quantityControls.forEach(control => {
    const minusBtn = control.querySelector("button:first-child");
    const plusBtn = control.querySelector("button:last-child");
    const countSpan = control.querySelector("span");

    let count = parseInt(countSpan.textContent);

    // Aksi tombol -
    minusBtn.addEventListener("click", () => {
      if (count > 0) {
        count--;
        updateCount();
      }
    });

    // Aksi tombol +
    plusBtn.addEventListener("click", () => {
      count++;
      updateCount();
    });

    function updateCount() {
      countSpan.textContent = count.toString().padStart(2, '0');
    }
  });
});
