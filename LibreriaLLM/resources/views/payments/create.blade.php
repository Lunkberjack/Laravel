@extends('layouts.app')
@section('content')
	<h1>Detalles de pago</h1>
	
	<h4 class="text-center"><strong>Total conjunto: </strong> {{ $order->total }}</h4>
	
	<div class="text-center mb-3">
		<form
			class="d-inline"
			method="POST"
			action="{{ route('orders.payments.store', ['order' => $order->id]) }}"
>		
			@csrf
			<button type="submit" class="btn btn-success">Pagar</button>
		</form>
	</div>
@endsection