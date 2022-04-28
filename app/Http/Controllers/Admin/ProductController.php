<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:products', 'min:5'],
            'price' => 'string',
            'category' => 'string',
            'ingredients' => 'string | nullable',
            'image' => 'nullable|image',
            'restaurant_id' => 'nullable| exists:restaurant,id',
        ]);
        $data = $request->all();

        $userId = Auth::id();
        $restaurantId = Restaurant::where('user_id', $userId)->value('id');
        $data['restaurant_id'] = $restaurantId;

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
        $request->validate([
            'name' => ['required', 'string', Rule::unique('products')->ignore($product->id), 'min:5'],
            'price' => 'string',
            'category' => 'string',
            'ingredients' => 'string | nullable',
            'image' => 'nullable|image',
            'restaurant_id' => 'nullable| exists:restaurant,id',
        ]);
        $data = $request->all();
        $product->update($data);

        return redirect()->route('admin.products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
