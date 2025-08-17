<x-app-layout>
    <x-slot name="title">
        Daftar Akun Baru
    </x-slot>

    <div class="container auth-container">
        <h2>Register</h2>

        {{-- Menampilkan semua error validasi jika ada --}}
        <x-alert type="error" />

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div>
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</x-app-layout>
