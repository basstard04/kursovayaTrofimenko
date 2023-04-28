let page = 8;
let stranica = 1;
document.addEventListener("DOMContentLoaded", () => {
  let brand = document.querySelector("#brand_selector").value;
  let color = document.querySelector("#color_selector").value;
  let size = document.querySelector("#size_selector").value;
  let type_of_good = [];
  let category = "";
  document.querySelectorAll(".btn_tip_obuvi").forEach((item) => {
    if (item.checked) {
      type_of_good.push(item.value);
    }
  });
  document.querySelectorAll(".btn_category_a").forEach((item) => {
    if (item.checked) {
      category = item.value;
    }
  });
  postJSON(
    "/app/tables/products/filterLoader.php",
    {
      brand: brand,
      size: size,
      color: color,
      types: type_of_good,
      category: category,
    },
    "filter"
  ).then(function (value) {
    let block = document.querySelector(".catalog_product-conteiner");
    block.innerHTML = "";
    let stranices = document.querySelector("#stranici");
    stranices.innerHTML = "";
    console.log(value.productInBasket.length);
    type_of_good.length;
    for (let i = 0; i < value.productInBasket.length / (page * stranica); i++) {
      stranices.insertAdjacentHTML(
        "beforeend",
        `<button data-str="${i + 1}" class = "stranici_selectors">${
          i + 1
        }</button>`
      );
    }
    for (let i = page * (stranica - 1); i < page * stranica; i++) {
      if (value.productInBasket[i]) {
        block.insertAdjacentHTML(
          "beforeend",
          `
        <div class="catalog_product">
                        <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                            <img class="product-img" src="/upload/product/${value.productInBasket[i].photo}" alt="${value.productInBasket[i].photo}">
                            <p class="catalog_p_productNew_name">${value.productInBasket[i].name}</p>
                        </a>
                        <div class="price-basket">
                            <p class="catalog_p_productNew_price">${Math.round(value.productInBasket[i].price)}₽</p>
                            <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                                <img class="btn-basket" src="/upload/titulnik/info.png" alt="basket">
                            </a>
                        </div>
                    </div>
        
        
        `
        );
      }
    }
  });
});

document.addEventListener("change", function (e) {
  if (e.target.classList.contains("filter")) {
    let brand = document.querySelector("#brand_selector").value;
    let color = document.querySelector("#color_selector").value;
    let size = document.querySelector("#size_selector").value;
    let type_of_good = [];
    let category = "";
    document.querySelectorAll(".btn_tip_obuvi").forEach((item) => {
      if (item.checked) {
        type_of_good.push(item.value);
      }
    });
    document.querySelectorAll(".btn_category_a").forEach((item) => {
      if (item.checked) {
        category = item.value;
      }
    });
    postJSON(
      "/app/tables/products/filterLoader.php",
      {
        brand: brand,
        size: size,
        color: color,
        types: type_of_good,
        category: category,
      },
      "filter"
    ).then(function (value) {
      let block = document.querySelector(".catalog_product-conteiner");
      block.innerHTML = "";
      let stranices = document.querySelector("#stranici");
      stranices.innerHTML = "";
      console.log(value.productInBasket.length);
      type_of_good.length;
      for (
        let i = 0;
        i < value.productInBasket.length / (page * stranica);
        i++
      ) {
        stranices.insertAdjacentHTML(
          "beforeend",
          `<button data-str="${i + 1}" class = "stranici_selectors">${
            i + 1
          }</button>`
        );
      }
      for (let i = page * (stranica - 1); i < page * stranica; i++) {
        console.log(value.productInBasket[i]);
        if (value.productInBasket[i]) {
          block.insertAdjacentHTML(
            "beforeend",
            `
          <div class="catalog_product">
                          <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                              <img class="product-img" src="/upload/product/${value.productInBasket[i].photo}" alt="${value.productInBasket[i].photo}">
                              <p class="catalog_p_productNew_name">${value.productInBasket[i].name}</p>
                          </a>
                          <div class="price-basket">
                              <p class="catalog_p_productNew_price">${Math.round(value.productInBasket[i].price)}₽</p>
                              <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                                  <img class="btn-basket" src="/upload/titulnik/info.png" alt="basket">
                              </a>
                          </div>
                      </div>
          `
          );
        }
      }
    });
  }
});
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("stranici_selectors")) {
    stranica = +e.target.dataset.str;
    let brand = document.querySelector("#brand_selector").value;
    let color = document.querySelector("#color_selector").value;
    let size = document.querySelector("#size_selector").value;
    let type_of_good = [];
    let category = "";
    document.querySelectorAll(".btn_tip_obuvi").forEach((item) => {
      if (item.checked) {
        type_of_good.push(item.value);
      }
    });
    document.querySelectorAll(".btn_category_a").forEach((item) => {
      if (item.checked) {
        category = item.value;
      }
    });
    postJSON(
      "/app/tables/products/filterLoader.php",
      {
        brand: brand,
        size: size,
        color: color,
        types: type_of_good,
        category: category,
      },
      "filter"
    ).then(function (value) {
      let block = document.querySelector(".catalog_product-conteiner");
      block.innerHTML = "";
      // let stranices = document.querySelector("#stranici");
      // stranices.innerHTML =""
      // for(let i = 0; i<value.productInBasket.lenght / (page * stranica); i++){
      //   stranices.insertAdjacentHTML('beforeend', `<button data-str="${i+1}" class = "stranici_selectors">${i+1}</button>`)
      // }
      for (let i = page * (stranica - 1); i < page * stranica; i++) {
        if (value.productInBasket[i]) {
          block.insertAdjacentHTML(
            "beforeend",
            `
          <div class="catalog_product">
                          <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                              <img class="product-img" src="/upload/product/${value.productInBasket[i].photo}" alt="${value.productInBasket[i].photo}">
                              <p class="catalog_p_productNew_name">${value.productInBasket[i].name}</p>
                          </a>
                          <div class="price-basket">
                              <p class="catalog_p_productNew_price">${Math.round(value.productInBasket[i].price)}₽</p>
                              <a class="catalog-product-a" href="/app/tables/products/show.php?id=${value.productInBasket[i].id}">
                                  <img class="btn-basket" src="/upload/titulnik/info.png" alt="basket">
                              </a>
                          </div>
                      </div>
          `
          );
        }
      }
    });
  }
});
