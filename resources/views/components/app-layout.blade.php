<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "WisataYuk" }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
</head>
<body>
    <x-alert></x-alert>
    <header>
        <div class="container">
            <a href="/" class="brand">WisataYuk</a>

            <nav class="nav-links">
                <a href="/">Beranda</a>
                <a href="{{route('destination')}}">Destinasi</a>
                @auth
                    <span class="nav-balance">Saldo: Rp {{number_format(auth()->user()->balance, 0, ',', '.')}}</span>
                    <a href="{{ route('profile') }}" class="nav-profile">Profile</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </nav>

            <div class="burger" id="burger" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </div>
        </div>
    </header>
    <div class="nav-overlay" id="navOverlay">
        <nav class="nav-overlay-menu">
            <a href="/">Beranda</a>
            <a href="{{route('destination')}}">Destinasi</a>
            @auth
                <span class="nav-balance">Saldo: Rp {{number_format(auth()->user()->balance, 0, ',', '.')}}</span>
                <a href="{{ route('profile') }}" class="nav-profile">{{auth()->user()->name}}</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </nav>
    </div>

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

<script>
  (function(){
    var burger = document.getElementById('burger');
    var overlay = document.getElementById('navOverlay');
    if (!burger || !overlay) return;

    function toggle() {
      overlay.classList.toggle('is-open');
      document.body.classList.toggle('no-scroll', overlay.classList.contains('is-open'));
      burger.setAttribute('aria-expanded', overlay.classList.contains('is-open') ? 'true' : 'false');
    }

    burger.addEventListener('click', toggle);
    overlay.addEventListener('click', function(e){
      if (e.target === overlay) toggle(); // klik area gelap untuk tutup
    });
  })();
</script>
</body>
</html>
