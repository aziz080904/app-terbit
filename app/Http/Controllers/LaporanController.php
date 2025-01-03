<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function show(){
        $list_laporan = Laporan::all(); // Eager loading relasi jenis
        return view('laporan.show', ['list_laporan' => $list_laporan]);
    }

    public function create()
    {
        $list_laporan = Laporan::all();
        $laporan = new Laporan();
        return view('laporan.form',['laporan'=>$laporan]);
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);
    
        // Menyimpan data laporan
        $laporan = new Laporan();
        $laporan->nama = $validated['nama'];
        $laporan->tanggal = $validated['tanggal'];
        $laporan->catatan = $validated['catatan'];
    
        // Menghandle upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('laporan', 'public');
            $laporan->lampiran = $lampiranPath;
        }
    
        // Simpan laporan ke database
        $laporan->save();
    
        // Redirect ke halaman detail setelah data disimpan
        return redirect()->route('laporan.show', ['id' => $laporan->id]);
    }
    

    public function edit($id)
    {
        $laporan = Laporan::find($id);
        $list_laporan = Laporan::all();
        return view('laporan.form',['laporan'=>$laporan]);
    }

    public function view($id)
    {
        $laporan = Laporan::find($id);

        // Jika laporan tidak ditemukan, tampilkan halaman 404
        if (!$laporan) {
            abort(404, 'Laporan tidak ditemukan');
        }

        return view('laporan.view', ['laporan' => $laporan]);
    }

    public function destroy($id): RedirectResponse
    {
        Laporan::find($id)->delete();
        return redirect(route('laporan.show'))->with('pesan', 'Data berhasil dihapus');
    }
}


