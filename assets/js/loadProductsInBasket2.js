document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("click", async (event) => {
      if (event.target.classList.contains("btn_Inbasket")) {
        let id = event.target.dataset.btnId;
        let size_id = 0;
        document.querySelectorAll(".size_ids").forEach(item =>{
          if(item.checked){
            size_id =item.value
          }
        })
        await postJSON("/app/tables/basket/save.basket.php", {"id":id, "size_id":size_id}, 'add');
      }
    });
  });
  