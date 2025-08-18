<x-app-layout>
    <x-slot name="title">
        Login Akun
    </x-slot>

    <div class="form-card">
        <h2>Login</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="form-switch-link">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</x-app-layout>
