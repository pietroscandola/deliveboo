@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Benvenuto</h1>

      @if ($restaurant)
         <h3 class="mb-3">Il tuo ristorante</h3>

         {{-- RISTORANTE INFO --}}

         <div class="row justify-content-center">
            <div class="col-xs-12 col-lg-6 d-flex justify-content-center">
               @if ($restaurant->image)
                  <img class="img-fluid rounded border" src="{{ asset('storage/' . $restaurant->image) }}"
                     alt="{{ $restaurant->name }}">
               @else
                  <figure>
                     <img class="img-fluid rounded mb-3 border"
                        src="https://www.zeusnews.it/img/4/8/1/6/2/0/026184-620-google-vedi-immagini.jpg" alt="img">
                  </figure>
               @endif
            </div>
            <div class="col-xs-12 col-lg-6 d-flex flex-column justify-content-between">
               <div class="mb-3">
                  <h5><strong>Nome Ristorante:</strong> {{ $restaurant->name }}</h5>
                  <hr>
                  <p><strong>Email:</strong> {{ $restaurant->email }}</p>
                  <p><strong>Cellulare:</strong> {{ $restaurant->phone }}</p>
                  <p><strong>Indirizzo:</strong> {{ $restaurant->address }}</p>
                  <p><strong>Partita IVA:</strong> {{ $restaurant->user->vat_number }}</p>
                  <p>
                     <strong>Categorie:</strong>
                     @foreach ($restaurant->categories as $category)
                        {{ $category->name }}
                        @if (!$loop->last)
                           ,
                        @endif
                     @endforeach
                  </p>
                  <p><strong>Descrizione:</strong> {{ $restaurant->description }}</p>
               </div>
               {{-- Buttons --}}
               <div class="d-flex justify-content-end">
                  <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                     class="btn btn-primary mr-3">Modifica</a>
                  {{-- <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                     @method('DELETE')
                     @csrf
                     <button type="submit" class="btn btn-danger">Elimina</button>
                  </form> --}}
               </div>
            </div>
         </div>
      @else
         <h2>Nessun ristorante: <a href="{{ route('admin.restaurants.create') }}">aggiungilo</a></h2>
      @endif

      {{-- CARD CIBO --}}



   </div>
@endsection
