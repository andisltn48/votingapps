<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(10);
        $totalParticipants = Participant::count();
        $todayParticipants = Participant::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact('participants', 'totalParticipants', 'todayParticipants'));
    }

    public function destroy($id)
    {
        Participant::findOrFail($id)->delete();
        return back()->with('success', 'Peserta berhasil dihapus.');
    }
}
