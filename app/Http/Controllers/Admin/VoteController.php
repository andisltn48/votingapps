<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $participants = Participant::select('id', 'nama')->get();
        return view('admin.voting', compact('participants'));
    }
}
