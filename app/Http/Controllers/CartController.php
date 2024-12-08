<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function saveOrder(Request $request)
{
    // Validate incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'payment_method' => 'required|string',
    ]);

    // Create the order
    $order = Order::create([
        'name' => $validated['name'],
        'address' => $validated['address'],
        'payment_method' => $validated['payment_method'],
        'total_price' => session('cart_total_price'), // Use session total price
    ]);

    // Check if the cart session is not empty
    if (session('cart') && is_array(session('cart'))) {
        // Add each item in the cart to the order_items table
        foreach(session('cart') as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
    }

    // Clear the cart after saving the order
    session()->forget('cart');

    // Redirect to a confirmation page or any other page
    return redirect()->route('orderConfirmation');
}

public function checkout(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'payment_method' => 'required|string',
    ]);

    // Save the order information
    $order = Order::create([
        'name' => $validated['name'],
        'address' => $validated['address'],
        'payment_method' => $validated['payment_method'],
        'total_amount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart', []))),
    ]);

    // Check if the cart session is not empty
    if (session('cart') && is_array(session('cart'))) {
        // Save the order items
        foreach (session('cart') as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'total_price' => $details['price'] * $details['quantity'],
            ]);
        }
    }

    // Clear the cart session
    session()->forget('cart');

    return redirect()->route('welcome', ['order' => $order->id]);
}

}
