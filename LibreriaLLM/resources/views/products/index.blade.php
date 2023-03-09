@extends ('layouts.app')
@section('content')
	<h1>Productos</h1>
	<!--Crea un botón que nos redirige a la pantalla de creación de productos-->
	<a class="mb-3 btn btn-success mb-3" href="{{ route('products.create') }}">Crear</a>
	@empty($products)
	    <div class="alert alert-warning">
	    	La lista de productos está vacía.
	    </div>
	@else
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Título</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Stock</th>
					<th>Estado</th>
					<th>Acciones</th>
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
						<a class="btn btn-link" href="{{  route('products.show', ['product' => $product->id]) }}">Mostrar</a>
						{{-- PARA INYECCIÓN AUTOMÁTICA, MOSTRAR EL TITLE EN LA RUTA
						<a class="btn btn-link" href="{{  route('products.show', ['product' => $product->title]) }}">Show</a> --}}
						<!--EDIT-->
						<a class="btn btn-link" href="{{  route('products.edit', ['product' => $product->id]) }}">Editar</a>
						<!--DELETE-->
						<form class="d-inline" method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
							@csrf
							@method('DELETE')
							<button class="btn btn-link" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endempty
@endsection