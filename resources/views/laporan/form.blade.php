<x-layout>
    <!-- Slot untuk Title dan Footer -->
    <x-slot name="title">Form Laporan Progres</x-slot>
    <x-slot name="card_title">Form Laporan</x-slot>
    <x-slot name="card_footer">@Terbit</x-slot>

    <h2 class="text-center">Form Laporan Progres Mahasiswa</h2>

    <!-- Form untuk Menambahkan atau Mengedit Data Laporan -->
    <form action="{{ route('laporan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <!-- Input Nama Mahasiswa -->
        <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $laporan->nama) }}" required>
        </div>

        <!-- Input Tanggal Input -->
        <div class="form-group">
            <label for="tanggal">Tanggal Input</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $laporan->tanggal) }}" required>
        </div>

        <!-- Input Catatan -->
        <div class="form-group">
            <label for="catatan">Catatan Progres</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ old('catatan', $laporan->catatan) }}</textarea>
        </div>

        <!-- Input Lampiran -->
        <div class="form-group">
            <label for="lampiran">Lampiran (PDF, PNG, JPEG)</label>
            <input type="file" name="lampiran" id="lampiran" class="form-control">
            @if($laporan->lampiran)
                <a href="{{ asset('storage/' . $laporan->lampiran) }}" target="_blank" class="btn btn-info">Lihat Lampiran</a>
            @else
                Tidak ada lampiran
            @endif
        </div>

        <!-- Tombol Batal dan Simpan -->
        <a href="{{ route('laporan.show') }}" class="btn btn-success mr-2">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</x-layout>
