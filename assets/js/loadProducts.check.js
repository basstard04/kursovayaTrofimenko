document.addEventListener("DOMContentLoaded", () => {
  let productsConteiner = document.querySelector(".product-conteiner");
  let categoryElements = document.querySelectorAll("[name='category']");
  let countProducts = document.querySelector(".count-products");
  let price = document.querySelector("#price");
  let country = document.querySelector("#country");
  let products = [];

  //загружаем все карточки с товарами
  getProducts("all");

  //при выборе категорий будем подгружать их товары
  categoryElements.forEach((item) => {
    item.addEventListener("change", async () => {
      //коллекцию флажков преобразовали в массив, затем нашли только включенные и достали их значения
      let checkedCategories = [...categoryElements]
        .filter((item) => item.checked)
        .map((item) => item.value);
      await getProducts(checkedCategories);
    });
  });

  //создаём функцию для загрузки данных
  async function getProducts(categories) {
    //формируем параметр
    const param = new URLSearchParams();
    param.append("category", JSON.stringify(categories));

    products = await getData("/app/tables/products/search.check.php", param);
    //выведим полученные данные на страницу
    outOnPage(products);
  }

  function outOnPage(products) {
    productsConteiner.innerHTML = ``;
    products.forEach((item) => {
      productsConteiner.insertAdjacentHTML("beforeend", createCard(item));
    });
    countProducts.textContent = `Найдено ${products.length} шт.`;
  }

  //создаём карточку товара
  function createCard({ id, name, image, price }) {
    return `<div class="col">
                <div class="card">
                    <img src="/upload/${image}" class="card-img-top" alt="${image}">
                    <div class="card-body">
                        <h5 class="card-title">${name}</h5>
                        <p class="card-text">${price}₽</p>
                    </div>
                    <a href="/app/tables/products/show.php?id=${id}" class="btn btn-primary">Подробнее</a>
                    <button class="btn-basket" id="btn-${id}" data-btn-id="${id}">В корзину</button>
                </div>
            </div>`;
  }

  price.addEventListener("click", () => {
    if (price.value == "ASC") {
      products.sort((a, b) => a.price - b.price);
    } else if (price.value == "DESC") {
      products.sort((a, b) => b.price - a.price);
    } else if (price.value == "country-ASC") {
      products.sort((a, b) => (a.country > b.country ? 1 : -1));
    } else if (price.value == "country-DESC") {
      products.sort((a, b) => (a.country < b.country ? 1 : -1));
    } else if (price.value == "name-DESC") {
      products.sort((a, b) => (a.name > b.name ? 1 : -1));
    } else if (price.value == "name-ASC") {
      products.sort((a, b) => (a.name < b.name ? 1 : -1));
    }
    outOnPage(products);
  });

  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-basket")) {
      let id = event.target.dataset.btnId;
      await postJSON("/app/tables/basket/save.basket.php", id, 'add');
    }
  });
});
