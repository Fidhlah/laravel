<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index(){
        $cars = Car::paginate(6);
        return view('frontend.car', compact('cars'));
    }

    public function available(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk mencari mobil yang tersedia berdasarkan tanggal
        $availableCars = Car::whereNotExists(function ($query) use ($startDate, $endDate) {
            $query->select(DB::raw(1))
                ->from('orders')
                ->where('cars.id', '=', DB::raw('orders.id_car'))
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->where('start_date', '<', $startDate)
                                ->where('end_date', '>', $endDate);
                        });
                });
        })->get();

        return view('frontend.car', compact('cars'));
    }

    
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