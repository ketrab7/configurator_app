<!-- tabela co powinna zawierać
-id
-type - typ danych [enum]?
-name - idname inputa
-title - nazwa wyswietlana
-information - podpowiedź
-priceFactor  - współczynnik ceny
-value - wartość domyślnie wyswietlona, albo wartość w select
-dependence - zależności np min max, ilość znaków w stringach....

string
text
integer
select
 -->
@extends('layouts.app')

@section('content')

<div class="container">
  <!-- wyswietlanie błędu jesli zle skonfigurowano produkt-->
  @if (session('status'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-title m-3"><h5 id="configuratorName">Konfigurator: {{$configurator->title}}</h5></div>
              <div class="card-subtitle ml-3"><h6 class="text-muted">{{$configurator->description}}</h6></div>
              <hr style="color:gray;">
                 <!--form-->
                <form class="justify-content-center" id="configuratorForm" name="configuratorForm" method="POST" action="{{ route('addToCart') }}">
                <!-- token weryfikujący żądanie -->
                @csrf
                  <div id="formConfigurator">
                  @foreach($modules as $option)
                    @switch($option->type)
                        @case('string')
                        <!-- string -->
                            <div class="form-group">
                                <div class="m-3">
                                    <label for="{{ $option->name }}" class="form-label">{{$option->title}}</label>
                                    <input type="text" class="form-control" id="{{ $option->name }}" placeholder="{{ $option->value }}">
                                    <input type="hidden" id="{{ $option->name }}Price" value="{{ $option->priceFactor }}">
                                    @if (isset($option->information))
                                      <div class="form-text">{{ $option->information }}</div><!-- podpowiedź -->
                                    @endif
                                </div>
                            </div>
                            @break

                        <!-- text -->
                        @case('text')
                          <div class="form-group">
                            <div class="m-3">
                              <label for="{{$option->name}}" class="form-label">{{$option->title}}</label>
                              <textarea class="form-control" form="configuratorForm" name="{{$option->name}}" id="{{$option->name}}" rows="3" placeholder="{{$option->value}}"></textarea>
                              <input type="hidden" id="{{$option->name}}Price" value="{{$option->priceFactor}}">
                              @if (isset($option->information))
                                <div class="form-text">{{$option->information}}</div><!-- podpowiedź -->
                              @endif
                            </div>
                          </div>
                          @break

                        <!-- integer -->
                        @case('integer')
                            <div class="form-group">
                                <div class="m-3">
                                    <label for="{{$option->name}}" class="form-label">{{$option->title}}</label>
                                    <input type="number" class="form-control" name="{{$option->name}}" id="{{$option->name}}" placeholder="{{$option->value}}" min="0">
                                    <input type="hidden" id="{{$option->name}}Price"  value="{{$option->priceFactor}}"><!-- przelicznik -->
                                    @if (isset($option->information))
                                      <div class="form-text">{{$option->information}}</div><!-- podpowiedź -->
                                    @endif
                                  </div>
                            </div>
                            @break

                        <!-- Select -->
                        @case('select')
                            <div class="form-group">
                                <div class="m-3">
                                    <label for="{{$option->name}}" class="form-label">{{$option->title}}</label>
                                    <select class="form-control" name="{{$option->name}}" id="{{$option->name}}" aria-label="Default select example">
                                        <?php
                                            $selectOptions = explode(';', $option->value);
                                        ?>
                                        @foreach($selectOptions as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="{{$option->name}}Price" value="{{$option->priceFactor}}">
                                    @if (isset($option->information))
                                      <div class="form-text">{{$option->information}}</div><!-- podpowiedź -->
                                    @endif
                                </div>
                            </div>
                            @break

                        @endswitch
                  @endforeach
                  </div> 
                    <!-- idConfiguratora -->
                    <input type="hidden" name="ConfiguratorID" value="{{ $configurator->id }}">
                    <!-- button trigger div modal -->
                    <div class="m-3">
                      <button type="button" id="summary" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Przejdź do podsumowania
                      </button>
                    </div>
                  <!-- modal w zewnętrznym blade-->
                  @include('configurator.modale')
                  <!-- skrypt wyświetlający modala-->
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
                  <!-- zewnętrzny plik z przeliczalnymi atrybutami do modala (plik w katalogu public)-->
                  <script src="{{asset('js/modale.js')}}"></script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
