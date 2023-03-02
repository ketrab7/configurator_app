@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card col-6 m-4 m-0 p-0">
                <div class="card-header text-center">
                    Zamówienie zostało przyjęte do sklepu, Dziękujemy za zakupy.
                </div>
                <div class="card-body text-center">
                    W wiadomości e-mail poinformujemy o zmianie statusu.
                    <hr/>
                    Jeżeli chcesz powrócić do naszego sklepu: 
                    <a class="btn btn-link" href="/configurator">Kliknij tutaj</a>
                </div>
            </div>
        </div>
    </div>
@endsection