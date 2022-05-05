<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::middleware('auth')->prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::get('/home', 'RestaurantController@show')->name('restaurant.home');

    // GRUPPO CESTINO PRODOTTI
    Route::prefix('products')->name('products.trash.')->group(function () {
        Route::get('/trash', 'ProductTrashController@index')->name('index');
        Route::patch('/{product}/trash', 'ProductTrashController@restore')->name('restore');
        Route::delete('/{product}/destroy', 'ProductTrashController@destroy')->name('destroy');
    });

    Route::resource('restaurants', 'RestaurantController');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
});

Route::prefix('pay')->group(function () {
    Route::get('/', function () {
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('pay', [
            'token' => $token
        ]);
    });

    Route::post('/checkout', function (Request $request) {
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Pinco',
                'lastName' => 'Pallo',
                'email' => 'pinco@pallo.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            return back()->with('success_message', 'Transaction successful. The ID is:' . $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: ' . $result->message);
        }
    });

    Route::get('/hosted', function () {
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('payform', [
            'token' => $token
        ]);
    });
});


Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
