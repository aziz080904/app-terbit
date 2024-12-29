<?php

namespace App\Http\Controllers;

use App\Models\Manajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    // Tampilkan semua tugas milik user
    public function show()
    {
        $manajemens = Manajemen::where('user_id', Auth::id())->get();
        return view('manajemens.show', compact('manajemens'));
    }



    // Tambahkan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'manajemen' => 'required|string|max:255',
        ]);

        $manajemen = Auth::user()->manajemens()->create([
            'manajemen' => $request->manajemen,
            'is_completed' => false,
        ]);

        return response()->json($manajemen);
    }

    // Update status tugas
    // Controller Method for Update
public function update(Request $request, $id)
{
    $manajemen = Manajemen::findOrFail($id);

    // Update the task completion status
    $manajemen->is_completed = $request->is_completed;
    $manajemen->save();

    return response()->json($manajemen);  // Kembalikan data task yang sudah diupdate
}

// Controller Method for Delete
public function destroy($id)
{
    $manajemen = Manajemen::findOrFail($id);
    $manajemen->delete();

    return response()->json(['message' => 'Task deleted successfully']);
}


}
