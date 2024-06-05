@extends('frontend.layout')

@section('content')


<div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay" style="background-image: url('frontend/images/hero_1.jpg')">
        <div class="container">
          
        </div>
      </div>
    </div>

    <div class="site-section pt-0 pb-0 bg-light">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <form action="{{ isset($car) ? route('orders.store') : route('cars.available') }}" method="POST" class="trip-form" id="order-form">
                      @csrf
                      <div class="row">
                        <div class="col-lg-12 text-center">
                          <h3>Mulai Perjalananmu</h3>
                        </div>
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

    <div class="site-section bg-light">
      <div class="container">
        @if($cars->isEmpty())
            <p class="text-center">Tidak ada mobil yang tersedia sekarang</p>
        @else
        <div class="row">
          <div class="col-lg-3">
            <h3>Koleksi Kami</h3>
            <p class="mb-4">Koleksi pilihan kami hadir untuk melengkapi setiap langkah menuju impian Anda.</p>
            <p>
              <a href="#" class="btn btn-primary custom-prev">Kembali</a>
              <span class="mx-2">/</span>
              <a href="#" class="btn btn-primary custom-next">Lanjut</a>
            </p>
          </div>
          <div class="col-lg-9">

            <div class="nonloop-block-13 owl-carousel">
            @foreach($cars as $car)
            <div class="item-1">
                <a href="#"><img src="{{ Storage::url($car->thumbnail) }}" alt="Image" class="img-fluid"></a>
                  <div class="item-1-contents">
                    <div class="text-center">
                        <h3><a href="#">{{ $car->nama }}</a></h3>
                        <!-- <div class="rating">
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                        </div> -->
                        <div class="rent-price"><span>Rp {{ number_format($car->harga, 0, ',', '.') }}/</span>hari</div>
                    </div>
                    <ul class="specs">
                        <!-- <li>
                            <span>Doors</span>
                            <span class="spec">4</span>
                        </li> -->
                        <li>
                            <span>Kursi</span>
                            <span class="spec">{{ $car->seat }}</span>
                        </li>
                        <li>
                            <span>Transmisi</span>
                            <span class="spec">{{ $car->transmisi }}</span>
                        </li>
                        <!-- <li>
                            <span>Minimum age</span>
                            <span class="spec">18 years</span>
                        </li> -->
                    </ul>
                    <div class="d-flex action ">
                        <a href="{{route('booking')}}" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                  </div>
            </div>
            @endforeach
            </div>
            
          </div>
        </div>
        @endif
      </div>
    </div>

    {{-- <div class="site-section section-3" style="background-image: url('/frontend/images/hero_2.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <h2 class="text-white">Our services</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-car-1"></span>
              </span>
              <div class="service-1-contents">
                <h3>Repair</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-traffic"></span>
              </span>
              <div class="service-1-contents">
                <h3>Car Accessories</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-valet"></span>
              </span>
              <div class="service-1-contents">
                <h3>Own a Car</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}


    {{-- <div class="container site-section mb-5">
      <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>How it works</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
        </div>
      </div>
      <div class="how-it-works d-flex">
        <div class="step">
          <span class="number"><span>01</span></span>
          <span class="caption">Time &amp; Place</span>
        </div>
        <div class="step">
          <span class="number"><span>02</span></span>
          <span class="caption">Car</span>
        </div>
        <div class="step">
          <span class="number"><span>03</span></span>
          <span class="caption">Details</span>
        </div>
        <div class="step">
          <span class="number"><span>04</span></span>
          <span class="caption">Checkout</span>
        </div>
        <div class="step">
          <span class="number"><span>05</span></span>
          <span class="caption">Done</span>
        </div>

      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-7 text-center mb-5">
            <h2>Customer Reviews</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="frontend/images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <span>John Williams</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="frontend/images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <span>Carl Smith</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, adipisci"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="frontend/images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                <span>Jenny Craig</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 --}}





@endsection
