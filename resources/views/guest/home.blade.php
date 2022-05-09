@extends('layouts.app')

@section('content')
   <div id="root"></div>
@endsection

@section('scripts')
   <script src="{{ asset('js/front.js') }}" defer></script>
   <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
   <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
@endsection
