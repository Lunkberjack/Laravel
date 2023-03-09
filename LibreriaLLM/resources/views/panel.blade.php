@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de administración</div>

                <div class="card-body">
                    <!--Muestra los productos para administrar-->
                    <div class="list-group">
                        <a class="list-group-item" href="{{ route('products.index') }}">
                            Editar productos
                        </a>

                        <a class="list-group-item" href="{{ route('users.index') }}">
                            Editar usuarios
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
