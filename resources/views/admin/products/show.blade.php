@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <figure class="d-flex justify-content-center">
                <img src="{{ $product->image }}" class="card-img-top w-25 img-fluid" alt="{{ $product->name }}">
            </figure>
            <div class="card-body">
                <h1 class="card-title font-weight-bold mb-3">{{ $product->name }}</h1>
                <p class="card-text mb-1"><strong>Categoria:</strong> {{ $product->category }}</p>
                <p class="card-text mb-1"><strong>Prezzo:</strong> {{ $product->price }}€</p>
                <p class="card-text mb-1"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
                <div class="d-flex justify-content-end">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class='delete_form'>
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Elimina">
                    </form>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning ml-1">Modifica</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary ml-1">Indietro</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src={{ asset('js/delete-confirm.js') }} defer></script>
@endsection
