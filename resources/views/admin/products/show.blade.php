@extends('layouts.app')

@section('content')
   <div class="col-12">
      <div class="card">
         <figure class="d-flex justify-content-center">
            <div class="mr-5 d-flex justify-content-center">
               @if ($product->image)
                  <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->title }}" width="200px"
                     class="img-fluid rounded mt-3">
               @else
                  <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
                     alt="image-null" width="200px" class="img-fluid">
               @endif
            </div>
         </figure>
         <div class="card-body">
            <h1 class="card-title font-weight-bold mb-3">{{ $product->name }}</h1>
            <p class="card-text mb-1"><strong>Categoria:</strong> {{ $product->category }}</p>
            <p class="card-text mb-1"><strong>Prezzo:</strong> {{ $product->price }}€</p>
            <p class="card-text mb-1"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
            <div class="d-flex justify-content-end">
               @if (!$product->deleted_at)
                  <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class='delete_form'>
                     @csrf
                     @method('DELETE')
                     <input type="submit" class="btn btn-danger" value="Elimina">
                  </form>
               @endif
               <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning ml-1">Modifica</a>
               @if (!$product->deleted_at)
                  <a href="{{ route('admin.products.index') }}" class="btn btn-primary ml-1">Indietro</a>
               @else
                  <a href="{{ route('admin.products.trash.index') }}" class="btn btn-primary ml-1">Indietro</a>
                  <form action="{{ route('admin.products.trash.restore', $product->id) }}" method="POST"
                     class="ml-1">
                     @csrf
                     @method('PATCH')
                     <button type="submit" class="btn btn-success">Recupera</button>
                  </form>
               @endif
            </div>
         </div>
      </div>
   </div>
@endsection

@section('scripts')
   <script src={{ asset('js/delete-confirm.js') }} defer></script>
@endsection
