async function outOnBasketPage(productId, action) {
  console.log(productId);
  return await postJSON("/app/admin/tables/save.admin.php", productId, action);
}

document.addEventListener("click", async (event) => {
  if (event.target.classList.contains("delete-category")) {
    outOnBasketPage(event.target.dataset.productId, "deleteCategory");
    event.target.closest(".category").remove();
  }
  if (event.target.classList.contains("delete-product")) {
    outOnBasketPage(event.target.dataset.productId, "deleteProduct");
    event.target.closest(".tr-product").remove();
  }
  if (event.target.classList.contains("info-category")) {
    let rez = outOnBasketPage(event.target.dataset.categoryId, "infoCategory");
    let productsTable = document.querySelector(".products-table");
    productsTable.innerHTML = "";
    rez.then(function (value) {
      value.productInBasket.forEach((element) => {
        productsTable.insertAdjacentHTML(
          "beforeend",
          `
        <tr>
        <td><img src="/upload/product/${element.photo}" alt="${element.name}" class="imageProd"> &nbsp</td>
        <td>${element.name} &nbsp</td>
        <td>${element.price} &nbsp</td>
        <td>${element.color} &nbsp</td>
        <td>${element.photo} &nbsp</td>
        <td>${element.country} &nbsp</td>
        <td>${element.category} &nbsp</td>
        </tr>
        `
        );
      });
    });
  }
});
