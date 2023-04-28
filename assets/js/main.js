document.addEventListener("click", function (e) {
  if (e.target.classList.contains("filter")) {
    postJSON(
      "/app/tables/products/filterLoader.php",
      e.target.dataset.id,
      "filterNewTowar"
    ).then(function (value) {
      let block = document.querySelector(".product-conteiner");
      block.innerHTML = "";
      value.productInBasket.forEach((element) => {
        block.insertAdjacentHTML(
          "beforeend",
          `
                <div class="product_new">
                <a class="catalog-product-a" href="/app/tables/products/show.php?id=${element.id}">
                    <img src="/upload/product/${element.photo}" alt="${element.photo}">
                    <p class="p_productNew_name">${element.name}</p>
                    <p class="p_productNew_price">${Math.round(element.price)}₽</p>
                </a>
            </div>`
        );
      });
    });
  }
});