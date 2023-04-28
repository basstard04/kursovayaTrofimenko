document.addEventListener("DOMContentLoaded", () => {
  let user = document.querySelector(".user");
  let modalWrapper = document.querySelector(".modal-wrapper");
  let modalClose = document.querySelector(".modal__close");
  let modal = document.querySelector(".modal");
  let sign = document.querySelector(".sign");
  let reg = document.querySelector(".reg");
  let btnBasketNoIin = document.querySelector(".btn-basket-no-in");
  let btnFindNoIn = document.querySelector(".btn-find-no-in");
  let btnReviewNoIn = document.querySelector(".btn-review-no-in");
  let btn_Inbasket_nezareg = document.querySelector(".btn_Inbasket_nezareg");
  let basketNoIn = document.querySelector(".basket-no-in");
  let userTertiary = document.querySelector(".user-tertiary");

  if (user != null) {
    user.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });
  }

  if (userTertiary != null) {
    userTertiary.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });
  }

  let closeModal = () => (modalWrapper.style.display = "none");

  document.addEventListener("keyup", (e) => {
    if (e.key == "Escape") {
      closeModal();
    }
  });

  if (btnBasketNoIin != null)
    btnBasketNoIin.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });

  if (btn_Inbasket_nezareg != null) {
    btn_Inbasket_nezareg.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });
  }

  if (btnFindNoIn != null)
    btnFindNoIn.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });

  if (btnReviewNoIn != null)
    btnReviewNoIn.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });

  if (basketNoIn != null) {
    basketNoIn.addEventListener("click", (e) => {
      e.preventDefault();
      modalWrapper.style.display = "block";
      modal.style.display = "block";
    });
  }

  //закрытие окна на крестик
  modalClose.onclick = function () {
    closeModal();
  };

  reg.addEventListener("click", () => {
    document.querySelector(
      ".modal__content"
    ).innerHTML = `<form class="entrance" action="" method="POST" id="form-reg">
      <input type="hidden" name="action" value="reg">
      <input type="text" name="name" id="" placeholder="Введите свое имя" class="input-reg-auth">
      <div class="div_pol">
          <input type="radio" hidden name="pol" class="radio-pol" id="pol_m" value="мужчина" checked>
          <label for="pol_m" class="label-pol">Мужчина</label>
          <input type="radio" hidden name="pol" class="radio-pol" id="pol_d" value="женщина">
          <label for="pol_d" class="label-pol">Женщина</label>
      </div>
  
      <input type="email" name="email" placeholder="Введите вашу почту" class="input-reg-auth" >

      <input type="phone" name="phone" placeholder="Введите ваш телефон" class="input-reg-auth">
  
      <input type="password" name="password" id="password" placeholder="Придумайте пароль" class="input-reg-auth">
  
      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароля" class="input-reg-auth">
      <p class="error-modal"></p>
      <div class="agreem">
          <label for="agreement">Согласен на обработку персональных данных</label>
          <input type="checkbox" checked name="agreement" id="agreement">
      </div>
      <button class="btn-reg btn-modal" name="btn-reg">
      <p>Зарегестрироваться</p>
      </button>
      </form>`;
    modal.style.height = "640px";
    modal.style.width = "500px";
    modalWrapper.style.paddingTop = "2.5rem";
    reg.style.borderBottom = "1px solid red";
    sign.style.borderBottom = "none";

    //   document.querySelector("#agreement").addEventListener("change", (e) => {
    //     document.querySelector(".btn-reg").disabled = !e.target.checked;
    //   });

    document
      .querySelector(".btn-reg")
      .addEventListener("click", async (event) => {
        let form = document.querySelector("#form-reg");
        event.preventDefault();
        let fd = new FormData(form);
        let res = await postFormData("/app/tables/users/save.user.php", fd);
        if (res.error != null) {
          document.querySelector(".error-modal").style.display = "block";
          document.querySelector(".error-modal").textContent = res.error;
        } else {
          closeModal();
          window.location.reload();
        }
      });
  });

  sign.addEventListener("click", () => {
    document.querySelector(
      ".modal__content"
    ).innerHTML = `<form class="entrance" action="" method="POST" id="form-auth">
        <input type="hidden" name="action" value="auth">
        <input class="entrance-input" type="email" placeholder="Введите логин" name="login">
        <input class="entrance-input" type="password" placeholder="Введите пароль" name="password">
        <p class="error-modal"></p>
        <button class="btn-auth btn-modal" name="btnAuth">
          <p>Войти</p>
        </button>
        <p class="help">Забыли логин / пароль?</p>
      </form>`;
    modal.style.height = "330px";
    modal.style.width = "400px";
    modalWrapper.style.paddingTop = "8rem";
    reg.style.borderBottom = "none";
    sign.style.borderBottom = "1px solid red";
  });

  document
    .querySelector(".btn-auth")
    .addEventListener("click", async (event) => {
      let form = document.querySelector("#form-auth");
      event.preventDefault();
      let fd = new FormData(form);
      let res = await postFormData("/app/tables/users/save.user.php", fd);
      if (res.user == null) {
        document.querySelector(".error-modal").style.display = "block";
        document.querySelector(".error-modal").textContent = res.error;
      } else {
        closeModal();
        window.location.reload();
      }
    });
});
