<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\JadwalUpcomingNotification;

class JadwalController extends Controller
{
    // Menampilkan semua jadwal
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil jadwal berdasarkan user ID dan role
        $jadwals = Jadwal::where('user_id', $user->id)
                        ->where('waktu', '>', Carbon::now())
                        ->get();

        return view('jadwals.index', compact('jadwals'));
    }
 

    // Menambahkan jadwal baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu' => 'required|date',
        ]);

        // Tambahkan user_id dan role ke data yang akan disimpan
        $validated['user_id'] = Auth::id();

        // Simpan jadwal
        $jadwal = Jadwal::create($validated);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }


    // Menghapus jadwal
    public function destroy($id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);
    
        // Pastikan hanya pemilik jadwal yang bisa menghapus
        if ($jadwal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Hapus jadwal
        $jadwal->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }
    


    // Cek jadwal mendatang dalam 2 jam
    public function checkUpcomingJadwals()
    {
        // Ambil jadwal yang akan datang dalam 2 jam
        $jadwals = Jadwal::where('waktu', '>', Carbon::now())
                         ->where('waktu', '<', Carbon::now()->addHours(10))
                         ->get();

        // Jika ada jadwal dalam 2 jam, tampilkan pesan alert
        if ($jadwals->isNotEmpty()) {
            $message = 'Ada jadwal yang akan segera dimulai dalam 10 jam:';
            foreach ($jadwals as $jadwal) {
                $message .= "\n- {$jadwal->judul} pada {$jadwal->waktu->format('d-m-Y H:i')}";
            }
            session()->flash('alert', $message);
        }

        return redirect()->route('jadwals.index');
    }
}