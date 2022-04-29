<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        return view('admin.home', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $restaurant = new Restaurant();
        return view('admin.restaurant.create', compact('restaurant', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'unique:restaurants', 'max:50'],
                'image' => ['nullable', 'image'],
                'email' => ['email', 'required'],
                'phone' => ['required', 'string', 'min:10'],
                'address' => ['required', 'string'],
                'description' => ['string', 'min:10']
            ],
            [
                'name.required' => 'Il nome del ristorante è obbligatorio',
                'name.unique' => 'Nome ristorante già esistente',
                'email.required' => 'Inserisci una E-Mail',
                'phone.required' => 'Inserisci un numero di telefono',
                'address.required' => 'Inserisci un indirizzo',
                'description.min' => 'La descrizione deve contenere almeno 10 carattteri',
            ]
        );

        $data = $request->all();
        $restaurant = new Restaurant();
        // dd($data);

        // Assegna id utente loggato al ristorante
        $data['user_id'] = Auth::id();

        // IMAGE input
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('restaurant_images', $data['image']);
            $data['image'] = $img_path;
        }

        $restaurant->fill($data);

        $restaurant->save();

        // Prende l'array di id delle categories e le associa
        if (array_key_exists('categories', $data)) {
            $restaurant->categories()->attach($data['categories']);
        }

        return redirect()->route('admin.restaurant.home'); // Riporta alla home
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $userId = Auth::id();
        $restaurant = $restaurant->where('user_id', $userId)->first();
        return view('admin.restaurant.home', compact('restaurant', 'userId'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        $selected_ids = $restaurant->categories->pluck('id')->toArray();
        return view('admin.restaurant.edit', compact('restaurant', 'categories', 'selected_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate(
            [
                'name' => ['required', 'string', Rule::unique('restaurants')->ignore($restaurant->id), 'max:50'],
                'image' => ['nullable', 'image'],
                'email' => ['email', 'required'],
                'phone' => ['required', 'string', 'min:10'],
                'address' => ['required', 'string'],
                'description' => ['string', 'min:10']
            ],
            [
                'name.required' => 'Il nome del ristorante è obbligatorio',
                'name.unique' => 'Nome ristorante già esistente',
                'email.required' => 'Inserisci una E-Mail',
                'phone.required' => 'Inserisci un numero di telefono',
                'address.required' => 'Inserisci un indirizzo',
                'description.min' => 'La descrizione deve contenere almeno 10 carattteri',
            ]
        );

        $data = $request->all();

        // IMG input
        if (array_key_exists('image', $data)) {
            if ($restaurant->image) Storage::delete($restaurant->image);
            $img_path = Storage::put('restaurant_images', $data['image']);
            $data['image'] = $img_path;
        }

        $restaurant->update($data);

        // Prende l'array di id delle categories e le associa
        if (!array_key_exists('categories', $data)) {
            $restaurant->categories()->detach();
        } else {
            $restaurant->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.restaurant.home', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {

        /*  $restaurant->orders()->delete();
        $restaurant->products()->delete();

        if ($restaurant->image) Storage::delete($restaurant->image);
        $restaurant->delete();
        return redirect()->route('admin.restaurant.home'); */
    }
}
