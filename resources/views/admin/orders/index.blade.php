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
        @foreach ($orders as $order)
        <div class="col-3 m-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->name }}</h5>
                    <p class="card-text"><strong>Nome:</strong> {{ $order->customer_name }}</p>
                    <p class="card-text"><strong>Cognome:</strong> {{ $order->customer_surname }}</p>
                    <p class="card-text"><strong>E-Mail:</strong> {{ $order->customer_email }}</p>
                    <p class="card-text"><strong>Indirizzo:</strong> {{ $order->customer_address }}</p>
                    <p class="card-text"><strong>Telefono:</strong> {{ $order->customer_phone }}</p>
                    <p class="card-text"><strong>Totale Ordine:</strong> {{ $order->amount }}€</p>
                    <p class="card-text"><strong>Data Creazione Ordine:</strong> {{ $order->created_at }}</p>
                    <p class="card-text"><strong> Stato Pagamento:</strong>@if($order->is_paid) Pagato @else Non Pagato @endif</p>
                    <p class="card-text"><strong>Stato Consegna:</strong>@if($order->is_delivered) Consegnato @else Non Cosegnato @endif</p>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Vedi</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">Modifica
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