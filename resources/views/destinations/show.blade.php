<x-app-layout>
    <x-slot name="title">
        Detail: {{ $destination->name }}
    </x-slot>

    <div class="container">
        <div class="detail-layout">
            <div class="detail-image">
                <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
            </div>

            <div class="detail-info">
                <h1>{{ $destination->name }}</h1>
                <p><strong>Stok Tersisa:</strong> {{ $destination->stock }} tiket</p>
                <p><strong>Harga Tiket:</strong> Rp {{number_format($destination->ticket_price, 0, ',', '.')}}</p>
            </div>

            <div class="description">
                <h3>Deskripsi</h3>
                <p>{{ $destination->description }}</p>
            </div>

            {{-- PERBAIKAN: Form ini sekarang selalu terlihat --}}
            <div class="booking-form form-card">
                <h3>Pesan Tiket</h3>
                <form action="{{ route('transactions.store', $destination) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Jumlah Tiket:</label>
                        <input type="number" id="quantity" name="quantity" class="form-input" value="1" min="1" max="{{ $destination->stock }}" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Metode Pembayaran:</label>
                        <select name="payment_method" id="payment_method" class="form-input" required>
                            {{-- Opsi saldo hanya muncul jika user login --}}
                            @auth
                                <option value="saldo">Gunakan Saldo (Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }})</option>
                            @endauth
                            <option value="cash">Bayar di Tempat (Cash)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                </form>
            </div>
        </div>


    </div>
</x-app-layout>
