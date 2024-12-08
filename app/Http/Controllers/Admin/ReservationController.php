<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function reservations() {
        $reservations = Reservation::all(); 
        return view('admin.reservation.reservation', compact('reservations'));
    }
    public function reserveMotorcycle(Request $request)
    {
    // Validate the request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'payment_method' => 'required|string',
        'reservation_date' => 'required|date',
    ]);

    // Save the reservation to the database
    Reservation::create([
        'name' => $request->input('full_name'), 
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone'),
        'payment_method' => $request->input('payment_method'),
        'preferred_reservation_date' => $request->input('reservation_date'), 
    ]);

    return redirect()->route('motorcycles')->with('success_message', 'Reservation submitted successfully!');
}



}
