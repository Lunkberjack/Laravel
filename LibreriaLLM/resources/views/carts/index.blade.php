@extends('layouts.app')

@section('content')
    <h1>Tu carrito</h1>
    @if ($cart->products->isEmpty())
        <div class="alert alert-warning">
            Tu carrito está vacío.
        </div>
    @else
        <a class="btn btn-success mb-3" href=" {{ route('orders.create') }} ">
            Realizar pedido
        </a>
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endempty
@endsection