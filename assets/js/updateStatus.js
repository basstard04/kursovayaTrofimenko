let td_status = document.querySelectorAll("#status");

td_status.forEach((item) => {
  if (item.innerHTML == "Готово к выдаче" || item.innerHTML == "Отменен") {
    displayNone(item.dataset.orderStatus);
  }
});

function displayNone(id){
  document.querySelector(`[data-order-update="${id}"]`).style.display = "none";
}
