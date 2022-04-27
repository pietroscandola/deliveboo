@if ($restaurant->exists)
   <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post"
      enctype="multipart/form-data">
      @method('PATCH')
   @else
      <form action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
   {{-- NAME --}}
   <div class="col-6 mb-3">
      <label for="name" class="form-label">Restaurant Name</label>
      <input name="name" type="text" class="form-control" id="name" value={{ old('name', $restaurant->name) }}>
   </div>
   {{-- EMAIL --}}
   <div class="col-6 mb-3">
      <label for="email" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="email" value={{ old('email', $restaurant->email) }}>
   </div>
   {{-- PHONE --}}
   <div class="col-6 mb-3">
      <label for="phone" class="form-label">Phone number</label>
      <input name="phone" type="tel" class="form-control" id="phone" value={{ old('phone', $restaurant->phone) }}>
   </div>
   {{-- ADDRESS --}}
   <div class="col-6 mb-3">
      <label for="address" class="form-label">Address</label>
      <input name="address" type="text" class="form-control" id="address"
         value={{ old('address', $restaurant->address) }}>

      {{ var_dump($restaurant->address) }}

   </div>
   {{-- CHECKBOX CATEGORIES --}}
   <div class="col-12 mb-3">
      <div class="form-check form-check-inline">
         @foreach ($categories as $category)
            {{-- name="categories[]" da alla request un array di valori --}}
            <input type="checkbox" class="form-check-input" name="categories[]" id="category-{{ $loop->iteration }}"
               value="{{ $category->id }}" @if (in_array($category->id, old('categories', $selected_ids ?? []))) checked @endif>
            <label class="form-check-label text-capitalize mr-2" for="category-{{ $loop->iteration }}">
               {{ $category->name }}
            </label>
         @endforeach
      </div>
   </div>
   {{-- DESC --}}
   <div class="col-12 mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" class="form-control" id="description"
         rows="3">{{ old('description', $restaurant->description) }}</textarea>
   </div>
</div>

<input class="btn btn-primary" type="submit" value="Invia">

</form>