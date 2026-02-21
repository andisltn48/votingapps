<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;

class AdminDashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $participants = Participant::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalParticipants = Participant::count();
        $todayParticipants = Participant::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact('participants', 'totalParticipants', 'todayParticipants'));
    }

    public function destroy($id)
    {
        Participant::findOrFail($id)->delete();
        return back()->with('success', 'Peserta berhasil dihapus.');
    }

    public function export(\Illuminate\Http\Request $request)
    {
        $search = $request->search;
        $date = $request->date;
        $fileName = 'pendaftar_' . now()->format('Y-m-d_His') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\ParticipantsExport($search, $date),
            $fileName
        );
    }
}
