@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Benvenuto</h1>

      @if ($restaurant)
         <h2>Il tuo ristorante</h2>

         {{-- RISTORANTE INFO --}}

         <div class="row justify-content-center">
            <div class="col-xs-12 col-lg-6 d-flex justify-content-center">
               @if ($restaurant->image)
                  <img class="img-fluid rounded" src="{{ asset('storage/' . $restaurant->image) }}"
                     alt="{{ $restaurant->name }}">
               @else
                  <img class="img-fluid rounded"
                     src="https://www.zeusnews.it/img/4/8/1/6/2/0/026184-620-google-vedi-immagini.jpg" alt="img">
               @endif
            </div>
            <div class="col-xs-12 col-lg-6 d-flex flex-column justify-content-between">
               <div>
                  <h5><strong>Nome:</strong> {{ $restaurant->name }}</h5>
                  <p><strong>Email:</strong> {{ $restaurant->email }}</p>
                  <p><strong>Cellulare:</strong> {{ $restaurant->phone }}</p>
                  <p><strong>Indirizzo:</strong> {{ $restaurant->address }}</p>
                  <p><strong>Descrizione:</strong> {{ $restaurant->description }}</p>
               </div>
               <div class="d-flex justify-content-end">
                  <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                     class="btn btn-primary mr-5">Modifica</a>
                  <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                     @method('DELETE')
                     @csrf
                     <button type="submit" class="btn btn-danger">Elimina</button>
                  </form>
               </div>
            </div>
         </div>
      @else
         <h2>Nessun ristorante: <a href="{{ route('admin.restaurants.create') }}">aggiungilo</a></h2>
      @endif

      {{-- CARD CIBO --}}



   </div>
@endsection
