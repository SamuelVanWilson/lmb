<x-app-layout>
    <x-slot name="title">
        Daftar Akun Baru
    </x-slot>

    <div class="form-card">
        <h2>Register</h2>

        {{-- Menampilkan semua error validasi jika ada --}}
        <x-alert type="error" />

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
        <p class="form-switch-link">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</x-app-layout>
