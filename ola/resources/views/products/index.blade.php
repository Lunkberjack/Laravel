@extends ('layouts.app')
@section('content')
	<h1>Products</h1>
	<!--Crea un botón que nos redirige a la pantalla de creación de productos-->
	<a class="mb-3 btn btn-success mb-3" href="{{ route('products.create') }}">Create</a>
	@empty($products)
	    <div class="alert alert-warning">
	    	The product list is empty.
	    </div>
	@else
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Description</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->title }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->stock }}</td>
					<td>{{ $product->status }}</td>
					<td class="d-inline-flex">
						<!--SHOW-->
						<a class="btn btn-link" href="{{  route('products.show', ['product' => $product->id]) }}">Show</a>
						{{-- PARA INYECCIÓN AUTOMÁTICA, MOSTRAR EL TITLE EN LA RUTA
						<a class="btn btn-link" href="{{  route('products.show', ['product' => $product->title]) }}">Show</a> --}}
						<!--EDIT-->
						<a class="btn btn-link" href="{{  route('products.edit', ['product' => $product->id]) }}">Edit</a>
						<!--DELETE-->
						<form class="d-inline" method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
							@csrf
							@method('DELETE')
							<button class="btn btn-link" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endempty
@endsection