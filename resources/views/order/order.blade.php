@extends('layouts.app')

@section('content')
<div class="container">

  <section>
    <div class="row">
      <div class="card-body col-12 col-md-8" style="background-color: #eee;">
        <div>
          <span><b>Podaj dane do wysyłki:</b></span>
          <form id="addOrder" action="/addOrder" method="POST">
            @csrf
          
            <div class="row">
              <div class="col">
                  <label for="surname" class="form-label">Nazwisko:</label>
                  <input type="text" class="form-control" name="surname"/>
              </div>
              <div class="col">
                  <label for="phone_number" class="form-label">Numer telefonu:</label>
                  <input type="number" class="form-control" name="phone_number"/>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col col-md-8">
                  <label for="address" class="form-label">Adres:</label>
                  <input type="text" class="form-control" name="address"/>
              </div>
              <div class="col col-md-4">
                  <label for="house_number" class="form-label">Numer domu:</label>
                  <input type="text" class="form-control" name="house_number"/>
              </div>
            </div>

            <div class="row mt-2">
              
              <div class="col">
                  <label for="city" class="form-label">Miasto:</label>
                  <input type="text" class="form-control" name="city"/>
              </div>
              <div class="col">
                  <label for="zip_code" class="form-label">Kod pocztowy:</label>
                  <input type="text" class="form-control" name="zip_code"/>
              </div>
              <div class="col">
                <label for="province" class="form-label">Województwo:</label>
                <select class="form-control" id="province" name="province">
                  <option value="dolnośląskie">dolnośląskie</option>
                  <option value="	kujawsko-pomorskie">kujawsko-pomorskie</option>
                  <option value="lubelskie">lubelskie</option>
                  <option value="lubuskie">lubuskie</option>
                  <option value="łódzkie">łódzkie</option>
                  <option value="małopolskie">małopolskie</option>
                  <option value="mazowieckie">mazowieckie</option>
                  <option value="opolskie">opolskie</option>
                  <option value="podkarpackie">podkarpackie</option>
                  <option value="podlaskie">podlaskie</option>
                  <option value="pomorskie">pomorskie</option>
                  <option value="śląskie">śląskie</option>
                  <option value="świętokrzyskie">świętokrzyskie</option>
                  <option value="warmińsko-mazurskie">warmińsko-mazurskie</option>
                  <option value="wielkopolskie">wielkopolskie</option>
                  <option value="zachodniopomorskie">zachodniopomorskie</option>
                </select>
              </div>
              <input type="hidden" name="payment_method" id="payment_method"/>
            </div>
          </form>

          <div class="mt-3 mb-2">
            <span><b>Wybierz sposób płatności:</b></span>
            <div class="check" onclick='checkFunction(event)'>
              <button class="m-2 button">
                <img src="https://i.imgur.com/WIAP9Ku.jpg" width="105px" height="55px" id="masterCard">
              </button>

              <button class="button m-2">
                <img src="https://i.imgur.com/OdxcctP.jpg" width="105px" height="55px" id="visa">
              </button>

              <button class="button m-2">
                <img src="https://i.imgur.com/cMk1MtK.jpg" width="105px" height="55px" id="PayPal">
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- prawa strona -->
      <!-- rabat -->
      <div class="col-12 col-md-4">
        <div class="p-3 mb-4" style="background-color: #eee;">
            <span><b>Kupon rabatowy:</b></span>
            <form action="/discount" method="post">
              @csrf
              <div class="row mt-2">
                <div class="col-md-9">
                  <input type="text" class="form-control" name="coupon">
                </div>
                <div class="col-md-2">
                  <button type="submit" id="summary" class="btn btn-secondary">
                      <img src="{{ asset('thumbnail/add.png') }}" alt="Show" width="20" height="20">
                  </button>
                </div>
              </div>  
              <div class="form-text">
              @if (session('errorDiscount'))
                {{ session('errorDiscount') }}
              @endif
              </div>      
            </form>
        </div>

        <!-- zamówienie -->
        <div class="p-3" style="background-color: #eee;">
          <span><b>Zamówienie:</b></span>
          <div class="d-flex justify-content-between mt-2">
            <span>Koszt całkowity:</span> <span>{{ number_format($orderPrice, 2, ',', ' '); }} PLN</span>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <span>Rabat:</span> <span>{{ number_format($discount, 2, ',', ' '); }} PLN</span>
          </div>
          <hr />
          <div class="d-flex justify-content-between mt-2">
            <span class="lh-sm">Całkowity koszt do zapłaty:</span>
            <span class="text-success">{{ number_format(($orderPrice - $discount), 2, ',', ' '); }} PLN</span>
          </div>
          <hr />
          <button type="submit" class="btn btn-success btn-lg btn-block" form="addOrder">Zamawiam i płacę</button>
        </div>

      </div>
    </div>
  </section>
</div>
<!-- zewnętrzny plik z zaznaczeniem i zwróceniem odpowiedniej metody płatności -->
<script src="{{asset('js/order-payment_method.js')}}"></script>

@endsection