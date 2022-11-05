@extends('layouts.master')
@section('content')
	<h1>{{ $product->title }} ({{ $product->id }})</h1>
	<p>{{$product->description}}</p>
	<p>{{$product->price}}</p>
	<p>{{$product->stock}}</p>
	<p>{{$product->status}}</p>
	<!-- Las dos exclamaciones permiten que el código html
	se interprete, es decir, se escape. -->
	<p>{!! $html !!}</p>
@endsection