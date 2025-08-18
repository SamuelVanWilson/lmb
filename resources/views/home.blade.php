<x-app-layout>
    <x-slot name="title">
        Selamat Data Di WisataYuk
    </x-slot>

    <section class="hero">
        <div class="hero-text">
            <h1>temukan tempat wisata unik di <b>WisataYuk</b></h1>
            <a href="{{ route('destination') }}">Jelajahi</a>
        </div>
    </section>

    <section class="about-us">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>WisataYuk adalah tempat anda untuk mencari wisata yang seru, beragam wisata kami sediakan disini</p>
        </div>
    </section>

    <section class="destinations">
        <div class="container">
            <h2>Destinasi Populer</h2>
            <div class="destination-grid">
                @forelse ($destinations as $destination)
                <div class="card">
                    {{-- Tampilkan gambar jika ada, jika tidak, gunakan placeholder --}}
                    @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
                    @else
                        <img src="https://placehold.co/600x400/0d6efd/FFFFFF?text=Wisata" alt="Gambar wisata">
                    @endif

                    <div class="card-body">
                        <h3>{{ $destination->name }}</h3>
                        {{-- Batasi deskripsi agar tidak terlalu panjang --}}
                        <p>{{ Str::limit($destination->description, 50) }}</p>
                        <a href="{{ route('destinations.show', $destination->name) }}" class="btn btn-secondary">Lihat Wisata</a>
                    </div>
                </div>
                @empty
                    {{-- Pesan ini akan muncul jika tidak ada data destinasi sama sekali --}}
                    <p>Belum ada destinasi yang ditambahkan.</p>
                @endforelse
            </div>

            <div class="see-all-container">
                <a href="{{route('destination')}}" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
    </section>
</x-app-layout>
