@extends('layouts.app')

@section('content')
<?php
    $totalPrice = 0;
    $lp = 1;

    //dd($cart);
?>

<div class="container">

    <h3><span><strong>Koszyk</strong></span></h3>
    <div class="row">
        <!--  tabela z zawartością koszyka-->
        <div class="col-12 col-md-8">
            <table class="table table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th class="w-10" scope="col">#</th>
                        <th class="w-40" scope="col">Nazwa</th>
                        <th class="w-10" scope="col">Cena</th>
                        <th class="w-10" scope="col">Ilość</th>
                        <th class="w-10" scope="col">Koszt</th>
                        <th class="w-30" scope="col">Pokaż</th>
                        <th class="w-30" scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $key => $item)
                        <tr data-id="{{ $key }}">
                            <th class="w-10" scope="row">{{ $lp }}</th>
                            <td class="w-40">{{ $item['productName'] }}</td>
                            <td class="w-10">{{ $item['productPrice'] }}</td>
                            <td class="w-10" data-th="Quantity">
                                <input type="number" value="{{ $item['productQuantity'] }}" class="form-control quantity update-cart" style="width:60px;">
                            </td>

                            <td class="w-10"><b>{{ number_format($item['productPrice'] * $item['productQuantity'], 2, ',', ' ') }}</b></td>

                            <td class="w-10">
                                <button type="button" id="summary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}">
                                    <img src="{{ asset('thumbnail/show.png') }}" alt="Show" width="20" height="20">
                                </button>
                            </td>

                            <td class="actions w-10" data-th="">
                                <button class="btn btn-danger  remove-from-cart">
                                    <img src="{{ asset('thumbnail/delete.png') }}" alt="Delete"  width="20" height="20">
                                </button>
                            </td>
                        </tr>
                        <?php
                        $totalPrice += $item['productPrice'] * $item['productQuantity'];
                        $lp++;
                        ?>
                    @endforeach
                </tbody>
            </table>

            <!-- modal w zewnętrznym blade-->
            @include('cart.modale')
        </div>
        <!--  podsumowanie-->
        <div class="col-12 col-md-4 pt-3" style="background-color: #eee;">
            <h5><b>Zamówienie:</b></h5>
            <hr />
            <div class="d-flex justify-content-between m-4">
                <span><b>Całkowity koszt:</b></span>
                <span><b> {{ number_format($totalPrice, 2, ',', ' ') }} PLN</b></span>
            </div>
            <hr />
            <div class="m-4">
                <a class="btn btn-secondary btn-lg btn-block" href="/configurator" role="button"> &#8592; Wróć do konfiguratora</a>
            </div>

            <div class="m-4">
                <a class="btn btn-success btn-lg btn-block" href="/orderSummary" role="button">Przejdź do podsumowania</a>
            </div>
        </div>
    </div>
</div>

<!-- skrypt wyświetlający modala-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<script type="text/javascript">
    //aktualizacja quantity
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
    //usuwanie wiersza z sesji
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection