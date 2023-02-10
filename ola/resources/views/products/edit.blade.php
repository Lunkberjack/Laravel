@extends('layouts.app')

@section('content')
    <h1>Edit a product</h1>

    <form
        method="POST"
        action="{{ route('products.update', ['product' => $product->id]) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')
        <div class="form-row">
            <label>Title</label>
            <!--La sintaxis ?? pregunta si old está definido por el usuario, ponemos ese, si no, ponemos
			el original. -->
            <input class="form-control" type="text" name="title" value="{{ old('title') ?? $product->title }}" required>
        </div>
        <div class="form-row">
            <label>Description</label>
            <input class="form-control" type="text" name="description" value="{{ old('description') ?? $product->description }}" required>
        </div>
        <div class="form-row">
            <label>Price</label>
            <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') ?? $product->price }}" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') ?? $product->stock }}" required>
        </div>
        <div class="form-row">
            <label>Status</label>
            <select class="custom-select" name="status" required>
                <option {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} value="available">
                    Available
                </option>

                <option {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }} value="unavailable">
                    Unavailable
                </option>
            </select>
        </div>
        <div class="form-row">
            <label>
                {{ __('Images') }}
            </label>

            <div class="custom-file">
                <input type="file" accept="image/*" name="images[]" class="custom-file-input" multiple>
                <label class="custom-file-label">
                    Product images...
                </label>
            </div>
        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Edit Product</button>
        </div>
    </form>
@endsection