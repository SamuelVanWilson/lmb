<x-app-layout>
    <x-slot name="title">
        Login Akun
    </x-slot>

    <div class="container auth-container">
        <h2>Login</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</x-app-layout>
