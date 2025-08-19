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

            <hr style="margin: 40px 0;">

            {{-- BAGIAN BARU: KOMENTAR --}}
            <div class="comments-section">
                <h2>Ulasan Pengunjung</h2>

                {{-- Form untuk menambah komentar --}}
                <div class="comment-form form-card">
                    <form action="{{ route('comments.store', $destination->name) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Tulis Komentarmu:</label>
                            <textarea name="content" id="content" class="form-input" rows="3" placeholder="Bagaimana pengalamanmu di sini?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>
                </div>

                {{-- Daftar komentar yang sudah ada --}}
                <div class="comment-list">
                    @forelse ($destination->comments as $comment)
                        <div class="comment-item">
                            <p class="comment-author"><strong>{{ $comment->user->name }}</strong></p>
                            <p class="comment-body">{{ $comment->content }}</p>
                            <p class="comment-date">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p style="text-align: center; margin-top: 20px;">Jadilah yang pertama memberikan ulasan!</p>
                    @endforelse
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
