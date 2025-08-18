<x-admin-layout>
    <div class="content-wrapper">

        <div class="content-header">
            <h1>Daftar Transaksi</h1>
        </div>

        <table border="1" cellpadding="5" class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Destinasi</th>
                    <th>Jumlah Tiket</th> {{-- <-- LABEL DIPERBARUI --}}
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->destination->name }}</td>
                    <td>{{ $transaction->quantity }}</td> {{-- <-- DATA BARU --}}
                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
