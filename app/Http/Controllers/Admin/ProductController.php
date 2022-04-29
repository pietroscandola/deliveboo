<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();

        $restaurant = Restaurant::where('user_id', $userId)->first();
        $products = $restaurant->products;
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();

        $categories = ['Primi Piatti', 'Secondi Piatti', 'Bevande', 'Pizze', 'Sushi'];

        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Recupera l'id del ristorante in cui si stanno modificando i prodotti
        $restaurantId = Restaurant::where('user_id', Auth::id())->value('id');

        $request->validate([
            'name' => ['required', 'string', Rule::unique('products')->where('restaurant_id', $restaurantId), 'min:3'],
            'price' => 'numeric',
            'category' => 'string',
            'ingredients' => 'string | nullable',
            'image' => 'nullable|image',
            'restaurant_id' => 'nullable| exists:restaurant,id',
        ]);
        $data = $request->all();

        // Give the product the restaurant id
        $userId = Auth::id();
        $restaurantId = Restaurant::where('user_id', $userId)->value('id');
        $data['restaurant_id'] = $restaurantId;

        // Image file
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('product_images', $data['image']);
            $data['image'] = $img_path;
        }

        $product = Product::create($data);

        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ['Primi Piatti', 'Secondi Piatti', 'Bevande', 'Pizze', 'Sushi'];

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Recupera l'id del ristorante in cui si stanno modificando i prodotti
        $restaurantId = Restaurant::where('user_id', Auth::id())->value('id');

        $request->validate([
            'name' => ['required', 'string', Rule::unique('products')->where('restaurant_id', $restaurantId)->ignore($product->id), 'min:3'],
            'price' => 'numeric',
            'category' => 'string',
            'ingredients' => 'string | nullable',
            'image' => 'nullable|image',
            'restaurant_id' => 'nullable| exists:restaurant,id',
        ]);
        $data = $request->all();


        // IMG input
        if (array_key_exists('image', $data)) {
            if ($product->image) Storage::delete($product->image);
            $img_path = Storage::put('product_images', $data['image']);
            $data['image'] = $img_path;
        }

        $product->update($data);

        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Image delete
        if ($product->image) Storage::delete($product->image);

        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
