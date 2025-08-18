<x-admin-layout>
    <x-slot name="title">
        Edit Destinasi: {{ $destination->name }}
    </x-slot>

    <h1>Edit Destinasi</h1>

    {{-- Form ini akan mengirim data ke method 'update' di DestinationController --}}
    <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Penting: Method untuk update adalah PUT --}}

        <div>
            <label for="name">Nama Destinasi:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $destination->name) }}" required>
        </div>
        <br>
        <div>
            <label for="location">Lokasi:</label><br>
            <input type="text" id="location" name="location" value="{{ old('location', $destination->location) }}" required>
        </div>
        <br>
        <div>
            <label for="description">Deskripsi:</label><br>
            <textarea id="description" name="description" required>{{ old('description', $destination->description) }}</textarea>
        </div>
        <br>
        <div>
            <label for="ticket_price">Harga Tiket:</label><br>
            <input type="number" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $destination->ticket_price) }}" required>
        </div>
        <br>
        <div>
            <label for="stock">Stok Tiket:</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $destination->stock) }}" required>
        </div>
        <br>
        <div>
            <label for="image">Gambar (Opsional):</label><br>
            <input type="file" id="image" name="image">
            @if($destination->image)
                <p>Gambar saat ini: <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}" width="100"></p>
            @endif
        </div>
        <br>
        <button type="submit">Perbarui</button>
    </form>
</x-admin-layout>
