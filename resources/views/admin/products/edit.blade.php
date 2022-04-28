@extends('layouts.app')

@section('content')
   <h1 class="mb-3">Modifica il Prodotto</h1>
   @include('admin.products.includes.form')
@endsection

@section('scripts')
   <script src="{{ asset('js/image-preview.js') }}" defer></script>
@endsection
