<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTrashController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $restaurant = Restaurant::where('user_id', $userId)->first();

        $products = Product::onlyTrashed()->where('restaurant_id', $restaurant->id)->get();
        return view('admin.products.trash.index', compact('products'));
    }

    public function restore()
    {
    }

    public function destroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('admin.products.trash.index');
    }
}
