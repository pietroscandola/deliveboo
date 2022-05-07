@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6 mb-3">
                <h1>Benvenuto</h1>
                <h3>I tuoi ordini</h3>
            </div>
        </div>

        {{-- RISTORANTE INFO --}}

        <div class="row justify-content-center">
            {{-- <div class="d-flex flex-wrap"> --}}
            @foreach ($orders as $order)
                <div class="col-xs-12 col-lg-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-text text-center"><strong>ID Ordine: {{ $order->id }}</strong></h5>
                            <hr>
                            <p class="card-text mt-5"><strong>Nome:</strong> {{ $order->customer_name }}</p>
                            <p class="card-text"><strong>Cognome:</strong> {{ $order->customer_surname }}</p>
                            <p class="card-text"><strong>E-Mail:</strong> {{ $order->customer_email }}</p>
                            <p class="card-text"><strong>Indirizzo:</strong> {{ $order->customer_address }}</p>
                            <p class="card-text"><strong>Telefono:</strong> {{ $order->customer_phone }}</p>
                            <p class="card-text"><strong>Totale Ordine:</strong> {{ $order->amount }}€</p>
                            <p class="card-text"><strong>Data Creazione Ordine:</strong> {{ $order->created_at }}</p>
                            <p class="card-text"><strong> Stato Pagamento:</strong>
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

                            <div class="d-flex justify-content-end mt-5">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary ml-1">
                                    Vedi
                                </a>
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
