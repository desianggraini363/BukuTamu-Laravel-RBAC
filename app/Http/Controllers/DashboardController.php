<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestbook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Ambil riwayat milik user yang login saja
        $myMessages = Guestbook::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard', compact('myMessages'));
    }

    public function adminIndex()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }

        // Admin mengambil data semua akun user dan seluruh isi buku tamu
        $allUsers = User::where('role', 'user')->latest()->get();
        $allGuestbook = Guestbook::with('user')->latest()->get();

        return view('admin.dashboard', compact('allUsers', 'allGuestbook'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        Guestbook::create([
            'user_id' => Auth::id(),
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Buku tamu berhasil disimpan!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'admin') {
            $guestbook = Guestbook::findOrFail($id);
            $guestbook->delete();
        }

        return redirect()->back()->with('success', 'Buku tamu berhasil dihapus!');
    }
}