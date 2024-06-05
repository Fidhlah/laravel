<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container p-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="mb-4">Riwayat Booking</h3>
                            @foreach ($bookingHistory as $booking)
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <span><strong>ID Pemesanan:</strong> {{ $booking->id }}</span>
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookingDetail{{ $booking->id }}" aria-expanded="false" aria-controls="bookingDetail{{ $booking->id }}">
                                            Detail Pesanan
                                        </button>
                                    </div>
                                    <div class="collapse" id="bookingDetail{{ $booking->id }}">
                                        <div class="card-body">
                                            <p><strong>Tanggal Pemesanan:</strong> {{ $booking->created_at->format('d-m-Y') }}</p>
                                            <p><strong>Status:</strong> {{ $booking->booking_stat }}</p>
                                            <p><strong>Tanggal Mulai:</strong> {{ $booking->start_date }}</p>
                                            <p><strong>Tanggal Selesai:</strong> {{ $booking->end_date }}</p>
                                            <p><strong>Waktu Penjemputan:</strong> {{ $booking->pickup_time }}</p>
                                            <p><strong>Total:</strong> Rp {{ number_format($booking->total, 0, ',', '.') }}</p>
                                            @if($booking->total_penalty > 0)
                                                <p><strong>Total Denda:</strong> Rp {{ number_format($booking->total_penalty, 0, ',', '.') }}</p>
                                            @endif
                                            @if($booking->car)
                                                <p><strong>Mobil:</strong> {{ $booking->car->nama }}</p>
                                                <img src="{{ asset('storage/' . $booking->car->thumbnail) }}" alt="{{ $booking->car->nama }}" style="width: 150px;">
                                            @endif
                                            @if($booking->driver)
                                                <p><strong>Driver:</strong> {{ $booking->driver->nama }}</p>
                                                <p><strong>Nomor Telepon:</strong> {{ $booking->driver->no_telp }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            @if ($bookingHistory->isEmpty())
                                <p class="text-center">Belum ada riwayat booking.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
