<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;


class HomepageController extends Controller
{
    public function index(){
        $cars = Car::all();
        $availableCarsCount = Car::where('status', 'Tersedia')->count(); // Menghitung jumlah mobil yang statusnya tersedia
    
        return view('frontend.homepage', compact('cars','availableCarsCount' ));
    }
}
