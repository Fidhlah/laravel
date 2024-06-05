<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order; // Perbaiki penulisan nama model
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $bookingHistory = Order::with('car', 'driver') // Eager loading relasi
                              ->where('id_customer', $userId) // Gunakan customer_id sebagai foreign key
                              ->orderBy('created_at', 'desc') // Urutkan descending berdasarkan created_at
                              ->get();
        // dd($bookingHistory);
        // Tidak perlu looping lagi untuk mengambil data mobil, sudah ada di $bookingHistory
        return view('dashboard', compact('bookingHistory'));
    }

    // public function showBookingHistory()
    // {
    //     $userId = Auth::id();
    //     $bookingHistory = Order::where('id_customer', $userId)->get(); // Perbaiki penulisan nama model
    //     return view('dashboard', compact('bookingHistory'));
    //     return view('frontend.homepage', compact('cars','availableCarsCount' ));

    // }
}
