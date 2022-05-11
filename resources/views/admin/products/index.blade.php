@extends('layouts.app')

@section('content')
   <div class="container py-4">
      <div class="row align-items-center">
         <div class="col-6 mb-3">
            <h1>Benvenuto</h1>
            <h3>I tuoi prodotti</h3>
         </div>
         <div class="col-6 d-flex justify-content-end">
            <a class="btn btn-secondary mx-2" href="{{ route('admin.products.trash.index') }}">
               <i class="fa-solid fa-trash-can fa-lg"></i>
            </a>
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">Crea</a>
         </div>
      </div>

      {{-- RISTORANTE INFO --}}

      <div class="row">
         {{-- <div class="d-flex flex-wrap"> --}}
         @foreach ($products as $product)
            <div class="col-xs-6 col-lg-4 col-md-6">
               <div class="card mb-3">
                  <div class="mt-3 d-flex justify-content-center">
                     @if (strpos($product->image, 'http') == false)
                        <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->title }}" width="200px"
                           class="img-fluid rounded border">
                     @elseif (strpos($product->image, 'http') !== false)
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" width="200px"
                           class="img-fluid rounded border">
                     @else
                        <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
                           alt="image-null" width="200px" class="img-fluid rounded border">
                     @endif
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center"><strong>{{ $product->name }}</strong></h5>
                     <hr>
                     <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>
                     <p class="card-text"><strong>Prezzo:</strong> {{ $product->price }}</p>
                     <p class="card-text"><strong>Categoria:</strong> {{ $product->category }}</p>
                     <p class="card-text"><strong>Ingredienti:</strong> {{ $product->ingredients }}</p>
                     <hr>
                     <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Vedi</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning ml-3 mr-3">
                           Modifica
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post"
                           class='delete_form'>
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger">Cestina</button>
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
