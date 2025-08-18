<x-app-layout>
    <x-slot name="title">
        Profil Saya
    </x-slot>

    <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
        <h1>Profil Saya</h1>

        {{-- Bagian Data User --}}
        <div class="profile-card">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Saldo:</strong> Rp {{ number_format($user->balance, 0, ',', '.') }}</p>

            {{-- Tombol Logout --}}
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>

        {{-- Bagian Riwayat Transaksi --}}
        <div class="profile-history">
            <h2>Riwayat Transaksi Saya</h2>
            <table border="1" class="history-table" cellpadding="10">
                <thead>
                    <tr>
                        <th>Destinasi</th>
                        <th>Jumlah Tiket</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->destination->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>
                            @if($transaction->status == 'berhasil')
                                <span class="status-berhasil">Berhasil</span>
                            @else
                                <span class="status-menunggu">Menunggu</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>{{ $transaction->created_at->format('d F Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Anda belum memiliki riwayat transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
