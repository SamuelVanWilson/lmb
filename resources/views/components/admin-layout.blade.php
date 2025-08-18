<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    {{-- Memanggil file CSS khusus admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
</head>
<body>
    <x-alert></x-alert>
    {{-- Header yang hanya muncul di tampilan mobile --}}
    <header class="admin-header-mobile">
        <div class="burger-menu" id="burgerMenu">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <div class="admin-layout">
        {{-- Sidebar Navigasi --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <h3>Admin Panel</h3>
            <nav>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.destinations.index') }}">Kelola Destinasi</a>
                <a href="{{ route('admin.transactions') }}">Lihat Transaksi</a>

                {{-- Form Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Konten Utama Halaman --}}
        <main class="admin-content">
            {{ $slot }}
        </main>
    </div>

    {{-- JavaScript untuk Menu Burger --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const burgerMenu = document.getElementById('burgerMenu');
            const adminSidebar = document.getElementById('adminSidebar');

            burgerMenu.addEventListener('click', function () {
                adminSidebar.classList.toggle('is-open');
            });
        });
    </script>

</body>
</html>
