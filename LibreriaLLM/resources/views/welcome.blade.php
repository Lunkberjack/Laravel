@extends('layouts.app')

@section('content')
    <h1 style="text-align:right; padding:1em;">¿Y si tu siguiente lectura te está esperando más abajo?</h1>
    <hr>
    @empty($products)
        <div class="alert alert-danger">
            Aún no hay productos :(
        </div>
    @else
    <div class="row">
        <!--Vídeo 82 (comentarios)-->
        {{--@dump($products)--}}

        @foreach($products as $product)
        <div class="col-3">
            @include('components.product-card')
        </div>
        @endforeach

       {{-- @dump($products)
        @dd(\DB::getQueryLog())--}}
    </div>
    @endempty
@endsection