<x-admin-layout>
    <div class="form-card">
        <h1>Tambah Destinasi Baru</h1>
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama:</label><input type="text" name="name" class="form-input" required></div>
            <div class="form-group"><label>Lokasi:</label><input type="text" name="location" class="form-input" required></div>
            <div class="form-group"><label>Deskripsi:</label><textarea name="description" class="form-input" required></textarea></div>
            <div class="form-group"><label>Harga Tiket:</label><input type="number" name="ticket_price" class="form-input" required></div>
            <div class="form-group"><label>Stok Tiket:</label><input type="number" name="stock" class="form-input" required></div> {{-- <-- INPUT BARU --}}
            <div class="form-group"><label>Gambar:</label><input type="file" name="image"></div>
            <button type="submit">Simpan</button>
        </form>
    </div>

</x-admin-layout>
