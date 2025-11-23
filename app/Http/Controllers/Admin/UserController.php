<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'penumpang')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Pastikan user yang dilihat adalah penumpang
        if ($user->role !== 'penumpang') {
            abort(404);
        }

        $bookings = $user->bookings()->with('travelSchedule')->get();
        
        return view('admin.users.show', compact('user', 'bookings'));
    }

    public function destroy(User $user)
    {
        // Pastikan user yang dihapus adalah penumpang
        if ($user->role !== 'penumpang') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Hanya dapat menghapus akun penumpang.');
        }

        // Cek apakah user memiliki Pesanan
        if ($user->bookings()->exists()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus penumpang yang memiliki riwayat Pesanan.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Penumpang berhasil dihapus!');
    }
}