@extends ('layouts.master')
@section('content')
	<h1>List of Products</h1>
	<!--Crea un botón que nos redirige a la pantalla de creación de productos-->
	<a class="btn btn-success" href="{{ route('products.create') }}">Create</a>
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
					<td>
						<!--SHOW-->
						<a class="btn btn-link" href="{{  route('products.show', ['product' => $product->id]) }}">Show</a>
						<!--EDIT-->
						<a class="btn btn-link" href="{{  route('products.edit', ['product' => $product->id]) }}">Edit</a>
						<!--DELETE-->
						<form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
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