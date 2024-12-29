<x-layout>
    <!-- Slot untuk Title dan Footer -->
    <x-slot name="title">Halaman Laporan Progres</x-slot>
    <x-slot name="card_title"></x-slot>
    <x-slot name="card_footer">@Terbit</x-slot>

    <h2 class="text-center">Laporan Progres Mahasiswa</h2>
    
    <!-- Tombol untuk Menambah Data (Hanya untuk admin) -->
    @if(Auth::user()->role == 'dosen')
        <a href="{{ route('laporan.create') }}">
            <button class="btn btn-primary mb-1">Tambah Data</button>
        </a>
    @endif

    <!-- Tabel untuk Menampilkan Data Laporan -->
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Input</th>
                <th>Catatan Progres</th>
                <th>Lampiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list_laporan as $laporan)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $laporan->nama }}</td>
                <td>{{ $laporan->tanggal }}</td>
                <td>{{ $laporan->catatan }}</td>

                <!-- Menampilkan Lampiran -->
                <td>
                    @if($laporan->lampiran)
                        <a href="{{ asset('storage/' . $laporan->lampiran) }}" target="_blank" class="btn btn-info">Lihat Lampiran</a>
                    @else
                        Tidak ada lampiran
                    @endif
                </td>

                <td>
                    <!-- Aksi untuk Admin: View, Edit, Delete -->
                    @if(Auth::user()->role == 'dosen')
                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="post">
                        <a href="{{ route('laporan.view', $laporan->id) }}" class="btn btn-transparant">
                            <i class="fas fa-eye text-info"></i>
                        </a>

                        <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-transparant">
                            <i class="fas fa-edit text-warning"></i>
                        </a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-transparant">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
