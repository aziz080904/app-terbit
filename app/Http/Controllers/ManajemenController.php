<?php

namespace App\Http\Controllers;

use App\Models\Manajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    // Menampilkan daftar tugas
    public function index()
    {
        $manajemens = Manajemen::orderBy('created_at', 'desc')->get();
        return view('manajemen.index', compact('manajemens'));
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'manajemen' => 'required|max:255',
        ]);

        Manajemen::create([
            'manajemen' => $request->manajemen,
            'is_completed' => false,
        ]);

        return redirect()->route('manajemen.index')->with('success', 'Task added successfully.');
    }

    // Mengupdate status tugas (is_completed)
    public function update(Request $request, Manajemen $manajemen)
    {
        $manajemen->update([
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('manajemen.index')->with('success', 'Task updated successfully.');
    }

    // Menghapus tugas
    public function destroy(Manajemen $manajemen)
    {
        $manajemen->delete();
        return redirect()->route('manajemen.index')->with('success', 'Task deleted successfully.');
    }
} 