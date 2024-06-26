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
        // Get dates from the request, validating if needed
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Convert dates to the 'Y-m-d' format
        $startDateFormatted = date('Y-m-d', strtotime($startDate));
        $endDateFormatted = date('Y-m-d', strtotime($endDate));

        // Query untuk mencari mobil yang tersedia berdasarkan tanggal
        $availableCars = Car::whereNotExists(function ($query) use ($startDateFormatted, $endDateFormatted) {
            $query->select(DB::raw(1))
                ->from('order')
                ->whereColumn('cars.id', 'order.id_car')
                ->where(function ($query) use ($startDateFormatted, $endDateFormatted) {
                    $query->whereBetween('start_date', [$startDateFormatted, $endDateFormatted])
                        ->orWhereBetween('end_date', [$startDateFormatted, $endDateFormatted])
                        ->orWhere(function ($query) use ($startDateFormatted, $endDateFormatted) {
                            $query->where('start_date', '<', $startDateFormatted)
                                ->where('end_date', '>', $endDateFormatted);
                        });
                });
        })->paginate(6); // Ubah angka 6 sesuai dengan jumlah data yang ingin ditampilkan per halaman

        $request->session()->put('startDate', $startDate);
        $request->session()->put('endDate', $endDate);

        return view('frontend.car', ['cars' => $availableCars]);
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