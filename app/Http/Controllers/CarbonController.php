<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarbonController extends Controller
{
    public function checkUpcomingJadwals()
    {
        // Ambil jadwal yang waktunya dalam 2 jam ke depan
        $jadwals = Jadwal::where('waktu', '>', Carbon::now())
                         ->where('waktu', '<', Carbon::now()->addHours(2))
                         ->get();

        if ($jadwals->isEmpty()) {
            return redirect()->route('jadwals.index')->with('info', 'Tidak ada jadwal dalam 2 jam ke depan.');
        }

        foreach ($jadwals as $jadwal) {
            // Buat notifikasi untuk setiap jadwal yang akan datang
            Notification::create([
                'message' => "Pengingat: Jadwal '{$jadwal->judul}' akan dimulai dalam 2 jam.",
                'icon' => 'fas fa-clock',
                'is_read' => false,
                'link' => route('jadwals.index'),
            ]);
        }

        return redirect()->route('jadwals.index')->with('success', 'Notifikasi berhasil dibuat untuk jadwal yang akan datang.');
    }
}
