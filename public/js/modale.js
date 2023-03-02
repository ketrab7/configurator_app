document.getElementById("summary").addEventListener("click", function(){
    //pobieram nazwę konfiguratora, usuwam pierwsze słowo i dodaję spację na koniec
    var configuratorName = document.getElementById('configuratorName').innerHTML.split(" ")[1]  + " ";
    //pobieram całego diva formConfigurator a następnie wyciągam z nich inputy
    var inputs = document.getElementById('formConfigurator').querySelectorAll('input, select, checkbox, textarea');
    var price = 0;
    var name, productPrice;

    for (var i=0; i<inputs.length; i+=2){
      if(inputs[i].type == "number"){
        configuratorName += inputs[i].value + "x";
        price += inputs[i].value * inputs[i + 1].value;
      } else {
        price *= inputs[i + 1].value;
      }
      //usuwam ostatni znak
      name = configuratorName.slice(0, -1);
      //zaokrąglam do 2 miejsc po przecinku
      price = price / 100;
      productPrice = price.toFixed(2);
      //zwracam dane do inputów
      document.getElementById("productName").value = name;
      document.getElementById("productPrice").value = productPrice;
    }

  })