async function outOnBasketPage(productId, action) {
  let { productInBasket, totalPrice, totalCount } = await postJSON(
    "/app/tables/basket/save.basket.php",
    productId,
    action
  );
  if (
    productInBasket != "delete" &&
    productInBasket != "clear" &&
    productInBasket != null
  ) {
    document.querySelector(
      `#count-${productInBasket.product_id}-${productInBasket.product_size_id}`
    ).textContent = `${productInBasket.count ?? 0}шт.`;
    document.querySelector(
      `#sumPrice-${productInBasket.product_id}-${productInBasket.product_size_id}`
    ).innerHTML = `${Math.round(productInBasket.price_position) ?? 0}₽`;
  }
  document.querySelector(".totalPrice").textContent = `Итог: ${
    Math.round(totalPrice) ?? 0
  }₽`;
  document.querySelector(".totalCount").textContent = `Товары в заказе: ${
    totalCount ?? 0
  }шт.`;
}

document.addEventListener("click", async (event) => {
  if (event.target.classList.contains("plus")) {
    outOnBasketPage(
      {
        id: event.target.dataset.productId,
        size_id: event.target.dataset.sizeId,
      },
      "add"
    );
  }
  if (event.target.classList.contains("minus")) {
    outOnBasketPage(
      {
        id: event.target.dataset.productId,
        size_id: event.target.dataset.sizeId,
      },
      "minus"
    );
  }
  if (event.target.classList.contains("delete")) {
    outOnBasketPage(
      {
        id: event.target.dataset.productId,
        size_id: event.target.dataset.sizeId,
      },
      "delete"
    );
    event.target.closest(".basket-position").remove();
    checkForEmp();
  }
  if (event.target.classList.contains("clear")) {
    outOnBasketPage(event.target.dataset.productId, "clear");
    document.querySelector(".totalPrice").style.display = "none";
    document.querySelector(".totalCount").style.display = "none";
    document.querySelector(".messageOne").textContent = "Корзина пуста";
    document.querySelector(".messageTwo").textContent = "Чтобы облегчить покупку войдите в личный кабинет. Вдруг у вас есть крутой список товаров, которые вы бы хотели приобрести.";
    document
      .querySelectorAll(".basket-position")
      .forEach((item) => item.remove());
    checkForEmp();
  }
});

function checkForEmp() {
  if (document.querySelectorAll(".basket-position").length == 0) {
    document.querySelector(".basket").style.display = "none";
    document.querySelector(".basket-null").style.display = "grid";
    document.querySelector(".totalPrice").style.display = "none";
    document.querySelector(".totalCount").style.display = "none";
    document.querySelector(".btn_zakaz").style.display = "none";
    document.querySelector(".clear").style.display = "none";
    document.querySelector(".messageOne").textContent = "Корзина пуста";
    document.querySelector(".messageTwo").textContent = "Чтобы облегчить покупку войдите в личный кабинет. Вдруг у вас есть крутой список избранных товаров или что-то завалялось в корзине. А за новинками — в каталог";
  }
}

checkForEmp();
