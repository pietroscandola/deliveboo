@extends('layouts.app')

@section('content')
   <div class="container py-4">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-text text-center"><strong>ID Ordine: {{ $order->id }}</strong></h5>
                  <hr>
                  <p class="card-text"><strong>Nome:</strong> {{ $order->customer_name }}</p>
                  <p class="card-text"><strong>Cognome:</strong> {{ $order->customer_surname }}</p>
                  <p class="card-text"><strong>E-Mail:</strong> {{ $order->customer_email }}</p>
                  <p class="card-text"><strong>Indirizzo:</strong> {{ $order->customer_address }}</p>
                  <p class="card-text"><strong>Telefono:</strong> {{ $order->customer_phone }}</p>
                  <p><strong>Prodotti nell'ordine:</strong></p>
                  <ul>
                     @foreach ($order->products as $product)
                        <li>
                           {{ $product->name }} x{{ $product->pivot->quantity }}
                           (<strong>{{ $product->pivot->quantity * $product->price }}</strong>€)
                        </li>
                     @endforeach
                  </ul>
                  <p class="card-text"><strong>Totale Ordine:</strong> {{ $order->amount }}€</p>
                  <p class="card-text"><strong>Data Creazione Ordine:</strong> {{ $order->created_at }}</p>
                  <p class="card-text"><strong>Stato Pagamento:</strong>
                     @if ($order->is_paid)
                        Pagato
                     @else
                        Non Pagato
                     @endif
                  </p>
                  <p class="card-text"><strong>Stato Consegna:</strong>
                     @if ($order->is_delivered)
                        Consegnato
                     @else
                        Non Cosegnato
                     @endif
                  </p>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('admin.orders.index') }}" class="btn btn-primary ml-1">Indietro</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
