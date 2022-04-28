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
   <div class="col-xs-12 col-md-6 mb-3">
      <div class="form-group">

         <label for="name" class="form-label">Nome della tua attività</label>
         <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $restaurant->name) }}">
      </div>
   </div>
   {{-- EMAIL --}}
   <div class="col-xs-12 col-md-6 mb-3">
      <div class="form-group">

         <label for="email" class="form-label">Email dell'attività</label>
         <input name="email" type="email" class="form-control" id="email"
            value="{{ old('email', $restaurant->email) }}">
      </div>
   </div>
   {{-- PHONE --}}
   <div class="col-xs-12 col-md-6 mb-3">
      <div class="form-group">

         <label for="phone" class="form-label">Numero di telefono</label>
         <input name="phone" type="tel" class="form-control" id="phone"
            value="{{ old('phone', $restaurant->phone) }}">
      </div>
   </div>
   {{-- ADDRESS --}}
   <div class="col-xs-12 col-md-6 mb-3">
      <div class="form-group">

         <label for="address" class="form-label">Indirizzo attività</label>
         <input name="address" type="text" class="form-control" id="address"
            value="{{ old('address', $restaurant->address) }}">
      </div>
   </div>
   {{-- CHECKBOX CATEGORIES --}}
   <div class="col-xs-12 col-md-6 mb-3">
      <div class="form-check form-check-inline d-flex flex-wrap">
         @foreach ($categories as $category)
            {{-- name="categories[]" da alla request un array di valori --}}
            <div class="d-flex align-items-center">
               <input type="checkbox" class="form-check-input" name="categories[]"
                  id="category-{{ $loop->iteration }}" value="{{ $category->id }}"
                  @if (in_array($category->id, old('categories', $selected_ids ?? []))) checked @endif>
               <label class="form-check-label text-capitalize mr-2" for="category-{{ $loop->iteration }}">
                  {{ $category->name }}
               </label>
            </div>
         @endforeach
      </div>
   </div>
   {{-- UPLOAD IMAGE --}}
   <div class="col-xs-12 col-md-6">
      <div class="form-group">
         <label for="image">Image</label>
         <input class="d-block" type="file" name="image" id="image">
      </div>
   </div>
   {{-- DESC --}}
   <div class="col-12 mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea name="description" class="form-control" id="description"
         rows="3">{{ old('description', $restaurant->description) }}</textarea>
   </div>
   <div class="col-12">
      <input class="btn btn-primary" type="submit" value="Invia">
   </div>
</div>

</form>
