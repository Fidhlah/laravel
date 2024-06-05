@extends('frontend.layout')

@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay innerpage" style="background-image: url('/frontend/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1>Halaman Pemesanan</h1>
                    <p>Koleksi pilihan kami hadir untuk melengkapi setiap langkah menuju impian Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section pt-0 pb-0 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ isset($car) ? route('orders.store') : route('cars.available') }}" method="POST" class="trip-form" id="order-form">
                    @csrf
                    <div class="row align-items-center mb-4">
                        <h3>Form Pemesanan</h3>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $startDate ?? '') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $endDate ?? '') }}" required>
                        </div>
                    </div>

                    @if(isset($car)) 
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="car_price" id="car_price" value="{{ $car->harga }}">
                        <input type="hidden" name="driver_option" id="driver_option" value="tanpa_driver">

                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Mobil yang Dipilih:</h4>
                                <div class="selected-car">
                                    <img src="{{ Storage::url($car->thumbnail) }}" alt="Image" class="img-fluid">
                                    <h3>{{ $car->nama }}</h3>
                                    <p>Harga: <span id="car_harga">{{ $car->harga }}</span> per hari</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Total Harga:</h4>
                                <p id="total_harga">Rp. 0</p>
                            </div>
                        </div>

                    @else
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary" name="action" value="search_car">
                                    <i class="fas fa-search"></i> Cari Mobil
                                </button>
                            </div>
                        </div>
                    @endif

                    @if(isset($car))
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="button-box">
                                    <div id="btn"></div>
                                    <button type="button" class="toggle-btn" onclick="leftClick()">Tanpa Driver</button>
                                    <button type="button" class="toggle-btn" onclick="rightClick()">Dengan Driver</button>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-lg-3 text-center">
                                        <div id="pickup_time_container" style="display:none;"> 
                                            <label for="pickup_time">Jam Diambil:</label>
                                            <input type="time" id="pickup_time" name="pickup_time" placeholder="Jam berapa mobil diambil" class="form-control timepicker px-3">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Syarat dan Ketentuan Tanpa Driver</th>
                                                <th scope="col">Syarat dan Ketentuan Dengan Driver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Isi tabel syarat dan ketentuan --}}
                                        </tbody>
                                    </table>
                                </div>
                                @auth
                                    @if (Auth::user()->role == 'user')
                                        <div class="row">
                                            <div class="col-lg-12 text-center mt-4">
                                                <button type="submit" class="btn btn-success btn-block" name="action" value="submit_order">Pesan Sekarang</button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">Hanya pengguna dengan role 'user' yang dapat memesan.</div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-block mt-4">Login untuk Memesan</a>
                                @endauth
                            </div>
                        </div>
                    @endif
                </form> 
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function calculateTotalPrice() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            const carPrice = parseFloat(document.getElementById('car_price').value);

            if (!isNaN(startDate) && !isNaN(endDate) && !isNaN(carPrice) && endDate >= startDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Include the start date

                const totalPrice = diffDays * carPrice;
                document.getElementById('total_harga').innerText = 'Rp. ' + totalPrice.toLocaleString();
            } else {
                document.getElementById('total_harga').innerText = 'Rp. 0';
            }
        }

        document.getElementById('start_date').addEventListener('change', calculateTotalPrice);
        document.getElementById('end_date').addEventListener('change', calculateTotalPrice);
        calculateTotalPrice(); // Initial calculation

        var btn = document.getElementById('btn');
        var pickupTimeContainer = document.getElementById('pickup_time_container');
        var driverOption = document.getElementById('driver_option');

        window.leftClick = function () {
            btn.style.left = '0%';
            btn.style.background = 'gray';
            pickupTimeContainer.style.display = 'none';
            driverOption.value = 'tanpa_driver'; 
        }

        window.rightClick = function () {
            btn.style.left = '50%';
            btn.style.background = '#007bff'; 
            pickupTimeContainer.style.display = 'block';
            driverOption.value = 'dengan_driver';
        }
    });
</script>
@endsection
