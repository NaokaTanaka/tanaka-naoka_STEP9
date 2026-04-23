document.addEventListener('DOMContentLoaded', function () {

  const dialog = document.querySelector("dialog");
  const showButton = document.getElementById("showDialog");
  const closeButton = document.getElementById("closeDialog");

  const productName = document.getElementById("productName").dataset.name;
  const quantityInput = document.querySelector(".quantity");
  const confirmText = document.getElementById("confirmText");

  showButton.addEventListener("click", (e) => {
    const quantity = quantityInput.value;
    confirmText.textContent = `${productName}${quantity}個購入しますか？`;
    dialog.showModal();
  });

  closeButton.addEventListener("click", () => {
    dialog.close();
  });

});