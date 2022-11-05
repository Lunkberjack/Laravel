<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Learn Laravel</title>
</head>
<body>
	<!--Errores internos de Laravel (VALIDACIÓN EN STORE)-->
	@dump($errors)
	<!--Si la sesión tiene un elemento llamado error-->
	@if(session()->has('error'))
	<div class="alert alert-danger">
		{{ session()->get('error') }}
	</div>
	@endif

	@if(session()->has('success'))
	<div class="success">
		{{ session()->get('success') }}
	</div>
	@endif

	<!--Si la variable errors está definida y además contiene algún elemento en la bolsa -->
	@if(isset($errors) && $errors->any())
	    <div class="alert alert-danger">
	    	<ul>
	    		@foreach ($errors->all() as $error)
	    			<li>{{ $error }}</li>
	    		@endforeach
	    	</ul>
	    </div>
	@endif

	@yield('content')
</body>
</html>