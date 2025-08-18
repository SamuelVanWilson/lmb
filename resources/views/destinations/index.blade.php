<x-app-layout>
    <x-slot name="title">
        Semua Destinasi Wisata
    </x-slot>

    <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
        <h2>Jelajahi Semua Destinasi Kami</h2>

        <div style="margin-top: 30px; margin-bottom: 30px;">
            <input type="text" id="searchInput" placeholder="Ketik nama wisata untuk mencari..." style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div class="destination-grid">
            @forelse ($destinations as $destination)
            <div class="card destination-card">
                <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">

                <div class="card-body">
                    {{-- Tambahkan class 'destination-name' untuk mengambil teks nama --}}
                    <h3 class="destination-name">{{ $destination->name }}</h3>
                    <p>{{ Str::limit($destination->description, 50) }}</p>
                    {{-- Pastikan link ini menggunakan nama, sesuai permintaan Anda sebelumnya --}}
                    <a href="{{ route('destinations.show', $destination->name) }}" class="btn btn-secondary">Lihat Detail</a>
                </div>
            </div>
            @empty
                <p>Belum ada destinasi yang tersedia.</p>
            @endforelse
        </div>

        {{-- Pesan ini akan muncul jika hasil pencarian kosong --}}
        <p id="noResultsMessage" style="display: none; text-align: center; margin-top: 20px; font-size: 18px;">Destinasi tidak ditemukan.</p>

    </div>

    {{-- 2. SCRIPT LIVE SEARCH (Sederhana dan Mudah Dihafal) --}}
    <script>
        // Ambil elemen input search
        const searchInput = document.getElementById('searchInput');

        // Tambahkan 'event listener' yang akan berjalan setiap kali user mengetik
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const destinationCards = document.querySelectorAll('.destination-card');
            const noResultsMessage = document.getElementById('noResultsMessage');
            let found = false;

            // Loop (ulangi pengecekan) untuk setiap kartu destinasi
            destinationCards.forEach(function(card) {
                // Ambil teks nama dari dalam kartu
                const destinationName = card.querySelector('.destination-name').textContent.toLowerCase();

                // Cek apakah nama destinasi mengandung kata yang dicari
                if (destinationName.includes(searchTerm)) {
                    card.style.display = 'block'; // Jika cocok, tampilkan kartunya
                    found = true;
                } else {
                    card.style.display = 'none'; // Jika tidak, sembunyikan
                }
            });

            // Tampilkan atau sembunyikan pesan "tidak ditemukan"
            if (found) {
                noResultsMessage.style.display = 'none';
            } else {
                noResultsMessage.style.display = 'block';
            }
        });
    </script>
</x-app-layout>
