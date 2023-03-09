@extends('layouts.app')
@section('content')
{{-- Para que la "carta" no ocupe todo el ancho de la pantalla
en la vista show del panel de administrador--}}
<div class="row justify-content-center">
	<div class="col-4">
		@include('components.product-card')
	</div>
</div>
@endsection