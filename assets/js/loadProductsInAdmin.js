document.addEventListener("DOMContentLoaded", () => {
  let productsConteiner = document.querySelector(".products-table");
  let categoryElements = document.querySelectorAll("[name='btn-category']");
  let products = [];

  //загружаем все карточки с товарами
  getProducts("all");

  //при выборе категорий будем подгружать их товары
  categoryElements.forEach((item) => {
    item.addEventListener("click", async (e) => {
      await getProducts(e.currentTarget.dataset.categoryId);
    });
  });

  //создаём функцию для загрузки данных
  async function getProducts(categories) {
    //формируем параметр
    const param = new URLSearchParams();
    param.append("category", categories);

    products = await getData("/app/admin/tables/search.product.php", param);
    console.log(categories);
    console.log(products);
    //выведим полученные данные на страницу
    outOnPage(products);
  }

  function outOnPage(products) {
    productsConteiner.innerHTML = ``;
    products.forEach((item) => {
      productsConteiner.insertAdjacentHTML("beforeend", createCard(item));
    });
  }

  //создаём карточку товара
  function createCard({
    id,
    name,
    price,
    color,
    photo,
    country,
    category,
    brand,
  }) {
    return `<tr class="tr-product">
    <td><img src="/upload/product/${photo}" alt="${name}" class="imageProd"></td>
    <td>${name}</td>
    <td>${price}</td>
    <td>${color}</td>
    <td>${country}</td>
    <td>${category}</td>
    <td>${brand}</td>
    <td><img class="btn-delete delete-product" src="/upload/titulnik/trash.svg" alt="trash" data-product-id="${id}"></td>
    <td><form action="/app/admin/tables/show.php" method="POST">
      <input hidden type="text" name="id" value="${id}">
      <button name="btn-show" class="btn-show">Редактировать</button>
    </form></td>
    </tr>`;
  }
});
