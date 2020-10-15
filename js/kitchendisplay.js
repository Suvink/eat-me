
document.getElementById("switch-orders").onclick = function () {
    location.href = "http://127.0.0.1:5500/routes/store/kitchendisplayOrders.html";
                    
};
 document.getElementById("switch-items").onclick = function () {
    location.href = "http://127.0.0.1:5500/routes/store/kitchendisplayInventory.html";
};



function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    
    
  }
  function togglePopup2(){
    
    document.getElementById("popup-2").classList.toggle("active");
    
  }
  function togglePopup3(){
    document.getElementById("popup-3").classList.toggle("active");
    
  }
//   function kk(){
//     var element = document.getElementById("shit");
//     element.classList.hide("pop-content2");
//   }



