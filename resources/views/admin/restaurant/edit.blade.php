@extends('layouts.app')

@section('content')
<form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control" id="name" value={{ old('name', $restaurant->name) }}>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" value={{ old('email', $restaurant->email) }}>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" rows="3">{{ old('description', $restaurant->description) }}</textarea>
    </div>

    <input type="submit" value="Invia">

</form>

@endsection