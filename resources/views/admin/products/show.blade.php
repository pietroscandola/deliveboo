@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <figure class="d-flex justify-content-center">
            <img src="{{ $product->iamge }}" class="card-img-top w-25 img-fluid" alt="">
        </figure>
        <div class="card-body">
            <h1 class="card-title font-weight-bold mb-3">{{ $product->name }}</h1>
            <p class="card-text mb-1"><strong>Categoria:</strong> {{ $product->category }}</p>
            <p class="card-text mb-1"><strong>Prezzo:</strong> {{ $product->price }}€</p>
            <p class="card-text mb-1"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
            <div class="d-flex justify-content-end">
                <a href="{{-- {{ route('admin.products.delete', $product->id) }}--}}" class="btn btn-danger ml-1">Delete</a>
                <a href="{{-- {{ route('admin.products.edit', $product->id) }}--}}" class="btn btn-warning ml-1">Edit</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary ml-1">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection 