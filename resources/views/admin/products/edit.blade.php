@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome del Prodotto</label>
            <input type="text" class="form-control" name="name" id="name" value={{ old('name', $product->name) }}>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" class="form-control" name="price" id="price" value={{ old('price', $product->price) }}
                step="0.01">
        </div>
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti</label>
            <textarea class="form-control" id="ingredients" name="ingredients"
                rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
        </div>
        <div class="mb-3 d-flex">
            <div class="col-10">
                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-2">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
                        class="img-fluid" id="preview">
                @endif
            </div>
        </div>

        <input type="submit" value="Invia">

    </form>
@endsection

@section('scripts')
    <script src="{{ asset('js/image-preview.js') }}" defer></script>
@endsection
