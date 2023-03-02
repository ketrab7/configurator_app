@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row justify-content-center">
    @foreach ($configurators as $configurator)

      <div class="card ml-1 mr-1" style="width: 18rem;">
        <div class="m-3">
          <img class="card-img-top" src="{{ $configurator->image }}" width=200 height=300 alt="Card image cap">
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $configurator->title }}</h5>
          <p class="card-text">{{ $configurator->description }}</p>
            <a href="configurator/module/{{ $configurator->id }}" class="btn btn-secondary btn-lg btn-block" role="button" name="{{ $configurator->type }}">
              {{ $configurator->button }}
            </a>
          </div>
      </div>

    @endforeach

  </div>
  @if (session('toast'))
    <!-- Toast w zewnętrznym blade-->
    @include('configurator.toastAddToCart')
  @endif
  <!-- Skrypt do wyświetlania toast'ów -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
  <script src="{{asset('js/toast.js')}}"></script>
</div>
@endsection
