<x-app-layout>
    <x-slot name="title">
        Selamat Data Di WisataYuk
    </x-slot>

    <section class="hero">
        <div class="hero-text">
            <h1>temukan tempat wisata unik di <b>WisataYuk</b></h1>
            <a href="{{ route('destinasi') }}">Jelajahi</a>
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
                @for($i = 0; $i < 6; $i++)
                <div class="card">
                    <img src="https://placehold.co/600x400/0d6efd/FFFFFF?text=Destinasi+{{ $i + 1 }}" alt="">
                    <div class="card-body">
                        <h3>Nama Destinasi {{$i + 1}}</h3>
                        <p>Surga bawah laut di ujung timur Indonesia.</p>
                        <a href="#"class="btn btn-secondary">Lihat Wisata</a>
                    </div>
                </div>
                @endfor
            </div>

            <div class="see-all-container">
                <a href="{{route('destinasi')}}" class="btn btn-primary">Lihat Semua</a>
            </div>
        </div>
    </section>
</x-app-layout>  
