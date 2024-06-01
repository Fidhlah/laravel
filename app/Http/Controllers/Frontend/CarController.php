<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(){
        $cars = Car::paginate(6);
        return view('frontend.car', compact('cars'));
    }

    // public function search(Request $request) {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $pickupTime = $request->input('pickup_time');
    //     $withDriver = $request->input('with_driver'); // Ambil informasi driver
    
    //     // Logika pencarian mobil yang tersedia berdasarkan tanggal dan waktu
    //     $availableCars = Car::whereDoesntHave('reservations', function($query) use ($startDate, $endDate) {
    //         $query->whereBetween('start_date', [$startDate, $endDate])
    //               ->orWhereBetween('end_date', [$startDate, $endDate]);
    //     })->get();
    
    //     return view('frontend.cars', compact('availableCars', 'startDate', 'endDate', 'pickupTime'));
    // }
    
    // app/Http/Controllers/CarController.php

public function select(Request $request) {
    $carId = $request->input('car_id');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $pickupTime = $request->input('pickup_time');

    $car = Car::find($carId);

    return view('frontend.driver', compact('car', 'startDate', 'endDate', 'pickupTime'));
}

}