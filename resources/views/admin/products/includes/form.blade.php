@if ($product->exists)
   <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
   @else
      <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
   {{-- ERROR --}}
   @if ($errors->any())
      <div class="col-12 alert alert-danger">
         <ul class="m-0">
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
   @endif
   {{-- NAME --}}
   <div class="col-12 mb-3">
      <label for="name" class="form-label">Nome del Prodotto</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
         value="{{ old('name', $product->name) }}">
      @error('name')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
   </div>
   {{-- PRICE --}}
   <div class="col-12 mb-3">
      <label for="price" class="form-label">Prezzo</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price"
         value="{{ old('price', $product->price) }}" step="0.01">
      @error('price')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
   </div>
   {{-- INGREDIENTS --}}
   <div class="col-12 mb-3">
      <label for="ingredients" class="form-label">Ingredienti</label>
      <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients"
         rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
      @error('ingredients')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
   </div>
   {{-- Categorie --}}
   <div class="col-12 mt-3 mb-3">
      <label for="category">Categoria</label>
      <select class="form-select" id="category" name="category" aria-label="Default select example">
         <option value="">--</option>
         @foreach ($categories as $category)
            <option @if ($product->category === $category) selected @endif value="{{ old('category', $category) }}">
               {{ $category }}</option>
         @endforeach
      </select>
   </div>
   {{-- IMAGE --}}
   <div class="col-12 mb-3">
      <div class="row">
         <div class="col-9">
            <div class="form-group">
               <label for="image">Immagine</label>
               <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                  name="image">
               @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>
         </div>
         <div class="col-3">
            @if ($product->image)
               <img class="img-fluid rounded" src="{{ asset('storage/' . $product->image) }}"
                  alt="{{ $product->name }}">
            @else
               <img class="img-fluid rounded"
                  src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
                  id="preview">
            @endif
         </div>
      </div>
   </div>
   <div class="col-12">
      <hr>
   </div>
   <div class="col-12 d-flex justify-content-end mt-3">
      <input class="btn btn-primary" type="submit" value="Invia">
   </div>
</div>

</form>
