@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-sm-6">
            <h1>Benvenuto</h1>
            <h2>I tuoi prodotti</h2>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-end">
            <a class="btn btn-secondary" href="{{ route('admin.products.create') }}">Crea</a>
        </div>
    </div>

    {{-- RISTORANTE INFO --}}

    <div class="row justify-content-center">
        {{-- <div class="d-flex flex-wrap"> --}}
        @foreach ($products as $product)
        <div class="col-3 m-3">
            <div class="card" style="width: 18rem;">
                <div class="mt-3 d-flex justify-content-center">
                    @if ($product->image)
                    <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->title }}" width="200px" class="img-fluid rounded">
                    @else
                    <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640" alt="image-null" width="200px" class="img-fluid">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }} ID: {{ $product->id }}</h5>
                    <p class="card-text"><strong>Prezzo:</strong> {{ $product->price }}</p>
                    <p class="card-text"><strong>Categoria:</strong> {{ $product->category }}</p>
                    <p class="card-text"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Vedi</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                            Modifica
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class='delete_form'>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Elimina">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{-- </div> --}}

    </div>
    {{-- CARD CIBO --}}
</div>
@endsection

@section('scripts')
<script src={{ asset('js/delete-confirm.js') }} defer></script>
@endsection