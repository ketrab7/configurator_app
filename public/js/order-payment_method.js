window.checkFunction = function(event) {
  
    document.querySelectorAll('button.button .active').forEach(function(item) {
      // usunięcie active z poprzedniego elementu
      item.classList.remove('active');
    })
    // dodanie class active do klikniętego elementu
    event.target.classList.add("active");
  
    //zwracam dane do inputu hidden, metoda płatności
    document.getElementById("payment_method").value = event.target.id;
};