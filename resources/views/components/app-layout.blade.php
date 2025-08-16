<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "WisataYuk" }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="brand">WisataYuk</a>
            <nav class="nav-links">
                <a href="/">Beranda</a>
                <a href="{{route('destinasi')}}">Destinasi</a>
                @auth
                    <span class="nav-balance">Saldo: Rp {{number_format(auth()->user()->balance, 0, ',', '.')}}</span>
                    <a href="{{ route('profile') }}" class="nav-profile">{{auth()->user()->name}}</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        {{$slot}}
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>Tentang WisataYuk</h4>
                    <p>Platform digital untuk mempromosikan keindahan pariwisata Indonesia dan memudahkan perjalanan Anda.</p>
                </div>
                <div class="footer-col">
                    <h4>Hubungi Kami</h4>
                    <p>Email: kontak@wisatayuk.com</p>
                    <p>Telepon: (021) 123-4567</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 LKS Pariwisata</p>
            </div>
        </div>
    </footer>
</body>
</html>
