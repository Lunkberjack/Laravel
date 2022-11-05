@extends('layouts.master')

@section('content')
<h1>Edit a product</h1>
<form method="POST" action="{{ route('products.update', ['product'=>$product->id]) }}">
	<!--Incluye un campo oculto que permite enviar formularios, ya que php por defecto no lo permite-->
	@csrf
	@method('PUT')
	<div class="form-row">
		<label>Title</label>
		<!--La sintaxis ?? pregunta si old está definido por el usuario, ponemos ese, si no, ponemos
		el original. -->
		<input class="form-control" type="text" name="title" value="{{ old('title') ?? $product->title }}"></input>
	</div>
	<div class="form-row">
		<label>Description</label>
		<input class="form-control" type="text" name="description" value="{{ old('description') ?? $product->description }}"></input>
	</div>
	<div class="form-row">
		<label>Price</label>
		<input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') ?? $product->price }}"></input>
	</div>
	<div class="form-row">
		<label>Stock</label>
		<input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') ?? $product->stock }}"></input>
	</div>
	<div class="form-row">
		<label>Status</label>
		<select class="custom-select" name="status">
			<option {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '')}} value="available" >Available</option>
			
			<option {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '')}} value="unavailable" >Unavailable</option>
		</select>
	</div>
	<div class="form-row">
		<button class="btn btn-primary btn-large" type="submit">Edit product</button>
	</div>
</form>
@endsection