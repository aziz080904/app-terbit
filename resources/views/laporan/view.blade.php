<x-layout>
    <!-- Slot untuk Title dan Footer -->
    <x-slot name="title">Detail Laporan</x-slot>
    <x-slot name="card_title">Detail Laporan :: {{ $laporan->nama }} -  {{ $laporan->tanggal_input }}</x-slot>
    <x-slot name="card_footer">@Parkir NF</x-slot>

    <!-- Tabel Detail Laporan -->
    <table class="table table-striped table-sm">
        <tr><th class="w-25">Nama</th><td>{{ $laporan->nama }}</td></tr>
        <tr><th>Tanggal Input</th><td>{{ $laporan->tanggal_input }}</td></tr>
        <tr><th>Catatan</th><td>{{ $laporan->catatan }}</td></tr>
        <tr><th>Lampiran</th>
            <td>
                @if($laporan->lampiran)
                    <a href="{{ asset('storage/'.$laporan->lampiran) }}" target="_blank">Lihat Lampiran</a>
                @else
                    Tidak ada lampiran
                @endif
            </td>
        </tr>
    </table>

    <!-- Tombol Kembali -->
    <div>
        <a href="{{ route('laporan.show') }}" class="btn btn-success mt-2">Kembali</a>
    </div>
</x-layout>
