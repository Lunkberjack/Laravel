@extends('layouts.master')

@section('content')
<h1>Create a product</h1>
<form method="POST" action="{{ route('products.store') }}">
	<!--Incluye un campo oculto que permite enviar formularios, porque php por defecto no lo permite-->
	@csrf
	<div class="form-row">
		<label>Title</label>
		<input class="form-control" type="text" name="title" value="{{ old('title') }}" required></input>
	</div>
	<div class="form-row">
		<label>Description</label>
		<input class="form-control" type="text" name="description" value="{{ old('description') }}" required></input>
	</div>
	<div class="form-row">
		<label>Price</label>
		<input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') }}" required></input>
	</div>
	<div class="form-row">
		<label>Stock</label>
		<input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') }}" required></input>
	</div>
	<div class="form-row">
		<label>Status</label>
		<select class="custom-select" name="status" required>
			<option value="" selected>Select...</option>
			<option {{ old('status') == 'available' ? 'selected' : '' }} value="available">Available</option>
			<option {{ old('status') == 'unavailable' ? 'selected' : '' }} value="unavailable">Unavailable</option>
		</select>
	</div>
	<div class="form-row">
		<button class="btn btn-primary btn-large" type="submit">Create product</button>
	</div>
</form>
@endsection