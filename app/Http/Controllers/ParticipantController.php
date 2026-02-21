<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function create()
    {
        return view('participant.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20|unique:participants,no_hp',
            'alamat' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'No HP wajib diisi.',
            'no_hp.unique' => 'No HP sudah terdaftar. Gunakan No HP lain.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        Participant::create($validated);

        return redirect()->route('participant.success');
    }

    public function success()
    {
        return view('participant.success');
    }
}
