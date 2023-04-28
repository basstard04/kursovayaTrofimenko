document.addEventListener("DOMContentLoaded", () => {
  let radioAll = document.querySelectorAll("[name='size']");
  let productId = document.querySelector("[name='id']");

  getSizes("RUS");

  function outOnPage(products, country) {
    document.querySelector(".sizes").innerHTML = ``;
    products.forEach((item) => {
      document
        .querySelector(".sizes")

        .insertAdjacentHTML(
          "beforeend",
          `<input hidden class="size_ids" name='size_value' type="radio" id="size-${item.id}" value='${item.id}'> <label for="size-${item.id}" class="size_ranges">${item[country]}</label>`
        );
    });
    document.querySelector(".size_ids").checked = true;
  }

  radioAll.forEach((item) => {
    item.addEventListener("change", async () => {
      await getSizes(item.value);
    });
  });

  //создаём функцию для загрузки данных
  async function getSizes(country) {
    const param = new URLSearchParams();
    param.append("country", country);
    param.append("product", productId.value);

    let sizes = await getData("/app/tables/products/search.check.php", param);

    //выведим полученные данные на страницу
    outOnPage(sizes, country);
  }
});
