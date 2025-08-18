<x-admin-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <h1>Daftar Destinasi</h1>
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">Tambah Destinasi Baru</a>
        </div>

        <table border="1" cellpadding="5"  class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Harga Tiket</th>
                    <th>Stok</th> {{-- <-- KOLOM BARU --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($destinations as $dest)
                <tr>
                    <td>{{ $dest->id }}</td>
                    <td>{{ $dest->name }}</td>
                    <td>{{ $dest->location }}</td>
                    <td>Rp {{ number_format($dest->ticket_price, 0, ',', '.') }}</td>
                    <td>{{ $dest->stock }}</td> {{-- <-- DATA BARU --}}
                    <td>
                        <a href="{{ route('admin.destinations.edit', $dest) }}">Edit</a>
                        <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
