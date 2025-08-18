<x-admin-layout>
    <x-slot name="title">
        Dashboard Admin
    </x-slot>

    <div class="content-wrapper">
        <div class="content-header">
            <h1>Selamat Datang, Admin!</h1>
            <p>Ini adalah halaman ringkasan untuk website Anda.</p>
        </div>

        <hr>

        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h2>Total User</h2>
                <p class="count">{{ $userCount }}</p>
            </div>
            <div class="dashboard-card">
                <h2>Total Transaksi</h2>
                <p class="count">{{ $transactionCount }}</p>
            </div>
        </div>
    </div>

</x-admin-layout>
