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
        // Ambil jadwal yang akan datang dalam 24 jam
        $jadwals = Jadwal::where('waktu', '>', Carbon::now())
                         ->where('waktu', '<', Carbon::now()->addDay())
                         ->get();

        // Cek jadwal mendatang dalam 2 jam
        $this->checkUpcomingJadwals();

        // Kirim data ke view
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

        // Tambahkan ke database
        $jadwal = Jadwal::create($validated);

        // Kirim notifikasi jika jadwal baru ditambahkan
        $user = Auth::user(); // Mengambil user yang sedang login
        $user->notify(new JadwalUpcomingNotification($jadwal)); // Memanggil notifikasi untuk jadwal yang baru

        // Kirim notifikasi via session
        $message = "Jadwal '{$jadwal->judul}' berhasil ditambahkan dan akan dimulai pada {$jadwal->waktu->format('d-m-Y H:i')}";
        session()->flash('success', $message);

        return redirect()->route('jadwals.index');
    }

    // Menghapus jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        session()->flash('success', "Jadwal '{$jadwal->judul}' berhasil dihapus.");
        return redirect()->route('jadwals.index');
    }

    // Cek jadwal mendatang dalam 2 jam
    public function checkUpcomingJadwals()
    {
        // Ambil jadwal yang akan datang dalam 2 jam
        $jadwals = Jadwal::where('waktu', '>', Carbon::now())
                         ->where('waktu', '<', Carbon::now()->addHours(2))
                         ->get();

        // Jika ada jadwal dalam 2 jam, tampilkan pesan alert
        if ($jadwals->isNotEmpty()) {
            $message = 'Ada jadwal yang akan segera dimulai dalam 2 jam:';
            foreach ($jadwals as $jadwal) {
                $message .= "\n- {$jadwal->judul} pada {$jadwal->waktu->format('d-m-Y H:i')}";
            }
            session()->flash('alert', $message);
        }

        return redirect()->route('jadwals.index');
    }
}