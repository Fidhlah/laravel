@extends('frontend.layout')

@section('content')
<div class="ftco-blocks-cover-1">
    <div class="ftco-cover-1 overlay innerpage" style="background-image: url('/frontend/images/hero_2.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1>Daftar Mobil Kami</h1>
                    <p>Koleksi pilihan kami hadir untuk melengkapi setiap langkah menuju impian Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
        @forelse($cars as $car)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="item-1">
                    <a href="#"><img src="{{ Storage::url($car->thumbnail) }}" alt="Foto {{ $car->nama }}" class="img-fluid"></a>
                    <div class="item-1-contents">
                        <div class="text-center">
                            <h3><a href="#">{{ $car->nama }}</a></h3>
                            <div class="rent-price"><span>Rp {{ number_format($car->harga, 0, ',', '.') }}/</span>hari</div>
                        </div>
                        <ul class="specs">
                            <li>
                                <span>Kursi</span>
                                <span class="spec">{{ $car->seat }}</span>
                            </li>
                            <li>
                                <span>Transmisi</span>
                                <span class="spec">{{ $car->transmisi }}</span>
                            </li>
                        </ul>
                        <div class="d-flex action">
                            <form action="{{ route('booking.after', ['car_id' => $car->id]) }}" method="GET">
                                <input type="hidden" name="start_date" value="{{ session('startDate') }}">
                                <input type="hidden" name="end_date" value="{{ session('endDate') }}">
                                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Tidak ada mobil yang tersedia sekarang</p>
            </div>
        @endforelse
            <div class="col-12">
                {{-- {{$cars->links('pagination::bootstrap-5')}} --}}
                <form action="{{ route('cars.available') }}" method="GET">
                    @csrf
                    {{ $cars->links('pagination::bootstrap-5') }}
                </form>                
            </div>
        </div>
    </div>
</div>

<div class="container site-section mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
            <h2>How it works</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
        </div>
    </div>
</div>
@endsection
