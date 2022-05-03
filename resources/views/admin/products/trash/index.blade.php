@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row align-items-center">
         <div class="col-6 mb-3">
            <h1>Benvenuto</h1>
            <h3>Cestino prodotti</h3>
         </div>
         <div class="col-6 d-flex justify-content-end">
            <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Torna ai piatti</a>
         </div>
      </div>

      {{-- RISTORANTE INFO --}}

      <div class="row">
         {{-- <div class="d-flex flex-wrap"> --}}
         @foreach ($products as $product)
            <div class="col-xs-6 col-lg-4 col-md-6">
               <div class="card mb-3">
                  <div class="mt-3 d-flex justify-content-center">
                     @if ($product->image)
                        <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->title }}" width="200px"
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
                     <div class="d-flex justify-content-around">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">
                           <i class="fa-solid fa-circle-info fa-lg"></i>
                        </a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                           <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.products.trash.restore', $product->id) }}" method="POST">
                           @csrf
                           @method('PATCH')
                           <button type="submit" class="btn btn-success">
                              <i class="fa-solid fa-arrow-rotate-left"></i>
                           </button>
                        </form>
                        <form action="{{ route('admin.products.trash.destroy', $product->id) }}" method="post"
                           class='delete_form'>
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger">
                              <i class="fa-solid fa-ban"></i>
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach

      </div>
   </div>
@endsection

@section('scripts')
   <script src={{ asset('js/delete-confirm.js') }} defer></script>
@endsection
