@extends('layouts.app')

@section('content')
<form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control" id="name" name="name" value={{ old('name', $restaurant->name) }}>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value={{ old('email', $restaurant->email) }}>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" value={{ old('phone', $restaurant->phone) }}>
    </div>
    {{-- @dd($restaurant->address); --}}
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value={{ old('address', $restaurant->address) }}>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $restaurant->description) }}</textarea>
    </div>

    <input class="btn btn-primary" type="submit" value="Invia">

</form>

@endsection