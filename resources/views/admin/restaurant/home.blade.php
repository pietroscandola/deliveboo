@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Benvenuto</h1>

      @if ($restaurant)
         <h2>Il tuo ristorante</h2>

         {{-- RISTORANTE INFO --}}

         <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
               <img src="https://www.zeusnews.it/img/4/8/1/6/2/0/026184-620-google-vedi-immagini.jpg" alt="img">
            </div>
            <div class="d-flex flex-column">
               <h5><strong>Nome:</strong> {{ $restaurant->name }}</h5>
               <p><strong>Descrizione:</strong> {{ $restaurant->description }}</p>
               <p><strong>Email:</strong> {{ $restaurant->email }}</p>
               <p><strong>Cellulare:</strong> {{ $restaurant->phone }}</p>
               <p><strong>Indirizzo:</strong> {{ $restaurant->address }}</p>
               <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-primary">AA</a>
            </div>
         </div>
      @else
         <h2>Nessun ristorante: aggiungilo</h2>
      @endif

      {{-- CARD CIBO --}}



   </div>
@endsection
