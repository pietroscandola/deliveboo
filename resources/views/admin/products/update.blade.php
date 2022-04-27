@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" value={{ old('name', $product->name) }}>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" value={{ old('email', $restaurant->email) }}>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description"
                rows="3">{{ old('description', $restaurant->description) }}</textarea>
        </div>

        <input type="submit" value="Invia">

    </form>
@endsection
