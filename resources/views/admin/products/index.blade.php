@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Benvenuto</h1>
        <h2>I tuoi prodotti</h2>

        {{-- RISTORANTE INFO --}}

        <div class="row justify-content-center">
            {{-- <div class="d-flex flex-wrap"> --}}
            @foreach ($products as $product)
                <div class="col-3 m-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text"><strong>Prezzo:</strong> {{ $product->price }}</p>
                            <p class="card-text"><strong>Categoria:</strong> {{ $product->category }}</p>
                            <p class="card-text"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Vedi</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-warning">Modifica
                            </a>                            
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- </div> --}}

        </div>

        {{-- CARD CIBO --}}



    </div>
@endsection
