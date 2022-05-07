@extends('layouts.app')

@section('content')
   <div class="container py-4">
      <h1 class="mb-3">Modifica il Prodotto</h1>
      @include('admin.products.includes.form')
   </div>
@endsection

@section('scripts')
   <script src="{{ asset('js/image-preview.js') }}" defer></script>
@endsection
