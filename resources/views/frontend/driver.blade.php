@extends('frontend.layout')

@section('content')
<div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay innerpage" style="background-image: url('frontend/images/hero_2.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>Pemesanan</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section pt-0 pb-0 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-12">
              <form action="{{ route('cars') }}" method="GET" class="trip-form">
                <div class="row align-items-center mb-4">
                  <div class="col-md-6">
                    <h3 class="m-0">Form Pemesanan</h3>
                  </div>
                  <div class="col-md-6 text-md-right">
                    <span class="text-primary">waduh</span> <span>cars available</span></span>
                  </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <h4>Detail Pesanan</h4>
                    </div>
                </div>

                
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="text"  id="start_date" placeholder="Kapan perjalanan dimulai" class="form-control datepicker px-3" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="text" id="end_date" placeholder="Kapan perjalanan berakhir" class="form-control datepicker px-3" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="cf-5">Jam Diambil</label>
                    <input type="time" id="cf-5" placeholder="Jam berapa mobil diambil" class="form-control timepicker px-3" required>
                  </div>
                  <span></span>
                  <div class="button-box col-md-6">
                    <div id="btn" ></div>
                    <button type="button" class="toggle-btn" onclick="leftClick()">Tanpa Driver</button>
                    <button type="button" class="toggle-btn" onclick="rightClick()">Dengan Driver</button>
                  </div>
                </div>

                <div class="row">

                </div>
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <!-- <input type="submit" value="Submit" class="btn btn-primary">
                   -->
                   <button class="btn btn-primary">
                      <i class="fas fa-search"></i>
                      <span class="text">Cari Mobil</span>
                  </button>
                   <!-- <button class="btn btn-primary"><i class="fas fa-search"> Cari Mobil</i></button> -->
                  </div>
                </div>
              </form>
              <!-- <div class="row"> -->
  <!-- @if(isset($car))
  <div class="col-12">
    <h4>Mobil yang Dipilih</h4>
    <div class="selected-car">
      <img src="{{ Storage::url($car->thumbnail) }}" alt="Image" class="img-fluid">
      <h3>{{ $car->name }}</h3>
      <p>Harga: {{ $car->price }}</p>
    </div>
  </div>
  @endif -->
<!-- </div> -->

            </div>
        </div>
      </div>
    </div>


  <script>
    var btn = document.getElementById('btn');

function leftClick() {
  btn.style.left = '0%';
  btn.style.background = 'gray';
}

function rightClick() {
  btn.style.left = '50%';
  btn.style.background = '#007bff'; 
}
      </script>
	<!-- <script src="index.js"></script> -->
@endsection