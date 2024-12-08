<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motorcycle;
use App\Models\Accessory;

class PageController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function motorcycles()
    {
        $motorcycles = Motorcycle::all();
        return view('motorcycles', compact('motorcycles')); 
    }

    public function showMotorcycles($id)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        return view('details', compact('motorcycle'));
    }

    public function accessories()
    {
        $accessories = Accessory::all();
        return view('accessories', compact('accessories'));
    }

    // Add an item to the cart
    public function addToCart(Request $request, $id)
    {
        $accessory = Accessory::findOrFail($id);

        // Add the accessory to the cart in the session
        $cart = session()->get('cart', []);
        
        // Check if the item already exists in the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $accessory->name,
                'price' => $accessory->price,
                'quantity' => 1,
                'image' => $accessory->image
            ];
        }

        // Save the cart in the session
        session()->put('cart', $cart);

        return redirect()->route('accessories');
    }

    // Show the cart
    public function cart()
    {
        $cart = session()->get('cart');
        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session(['cart' => $cart]);

            $totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $totalQuantity = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
            ]);
        }

        return response()->json(['success' => false]);
    }


}
