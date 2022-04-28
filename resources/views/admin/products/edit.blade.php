@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Modifica il Prodotto</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 mb-3">
                <label for="name" class="form-label">Nome del Prodotto</label>
                <input type="text" class="form-control" name="name" id="name" value={{ old('name', $product->name) }}>
            </div>
            <div class="col-12 mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control" name="price" id="price" value={{ old('price', $product->price) }}
                    step="0.01">
            </div>
            <div class="col-12 mb-3">
                <label for="ingredients" class="form-label">Ingredienti</label>
                <textarea class="form-control" id="ingredients" name="ingredients"
                    rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
            </div>
            {{-- Categorie --}}
            <div class="col-12 mt-3 mb-3">
                <label for="category">Categoria</label>
                <select class="form-select" id="category" name="category" aria-label="Default select example">
                    <option value="">--</option>
                    @foreach ($categories as $category)
                        <option @if ($product->category === $category) selected @endif value="{{ old('category', $category) }}">
                            {{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Immagine</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                                name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        @if ($product->image)
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img class="img-fluid rounded" src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
                                class="img-fluid" id="preview">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <input class="btn btn-primary" type="submit" value="Invia">
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script src="{{ asset('js/image-preview.js') }}" defer></script>
@endsection
