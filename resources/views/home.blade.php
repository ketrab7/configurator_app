@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert"> 
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--tu będzie konspekt pracy inż.-->
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                    It has survived not only five centuries, but also the leap into electronic typesetting, 
                    remaining essentially unchanged. It was popularised in the 1960s with the release of 
                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like 
                    Aldus PageMaker including versions of Lorem Ipsum.
                    </br>
                    <!--<button type="submit" name="button" formaction="/configurator">test</button>-->
                    <a class="btn btn-secondary" href="/configurator" role="button">Przejdź do konfiguratora</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
