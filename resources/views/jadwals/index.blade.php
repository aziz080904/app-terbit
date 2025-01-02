<x-layout>
    <x-slot name="title">Daftar Jadwal</x-slot>
    <x-slot name="card_title">Jadwal Bimbingan</x-slot>
    <x-slot name="card_footer">{{ now()->format('d M Y') }}</x-slot>

    <!-- Menampilkan success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <form action="{{ route('jadwals.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="datetime-local" class="form-control" id="waktu" name="waktu" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
        </form>
    </div>
    <br>
    <h3>Jadwal Mendatang</h3>
        <ul>
            @foreach ($jadwals as $jadwal)
                <li>
                    <strong>{{ $jadwal->judul }}</strong><br>
                    <p>{{ $jadwal->deskripsi }}</p>
                    <p><em>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('d M Y, H:i') }}</em></p>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>


</x-layout>