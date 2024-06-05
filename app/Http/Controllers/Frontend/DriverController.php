<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\driver;
use App\Models\order;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        return view('frontend.driver');
    }

    public function booking(Request $request, $car_id){
        $startDate = $request->query('start_date', $request->session()->get('startDate'));
        $endDate = $request->query('end_date', $request->session()->get('endDate'));
        $pickupTime = $request->query('pickup_time');

        // Store dates in session for later use
        $request->session()->put('startDate', $startDate);
        $request->session()->put('endDate', $endDate);
        $request->session()->put('pickupTime', $pickupTime);

        $car = Car::find($car_id);
        return view('frontend.driver', compact('car', 'startDate', 'endDate', 'pickupTime'));
    }

    public function store(Request $request) {
        if ($request->has('action')) {
            $action = $request->action;
    
            if ($action === 'search_car') {
                $validatedData = $request->validate([
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
    
                return redirect()->route('booking')->with($validatedData);
            } elseif ($action === 'change_car') {
                $request->session()->forget('car');
    
                return redirect()->route('booking');
            } elseif ($action === 'submit_order') {
                $validatedData = $request->validate([
                    'car_id' => 'required|exists:cars,id',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                    'driver_option' => 'required|in:tanpa_driver,dengan_driver',
                    'pickup_time' => 'nullable|date_format:H:i',
                ]);
    
                $car = Car::find($validatedData['car_id']);
                $startDate = new \DateTime($validatedData['start_date']);
                $endDate = new \DateTime($validatedData['end_date']);
                $days = $startDate->diff($endDate)->days + 1; // Include the start date
                $total = $days * $car->harga;
    
                $orderData = [
                    'id_customer' => auth()->id(),
                    'id_car' => $validatedData['car_id'],
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'id_driver' => $validatedData['driver_option'] === 'dengan_driver' ? 1 : null,
                    'total' => $total, // Save the calculated total price
                ];
    
                $order = Order::create($orderData);
    
                return redirect()->route('riwayat')->with('message', 'Pesanan berhasil dibuat!');
            }
        }
    
        return redirect()->route('booking');
    }
    


}
