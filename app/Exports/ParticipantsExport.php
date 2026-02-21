<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParticipantsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $search;
    protected $date;

    public function __construct($search = null, $date = null)
    {
        $this->search = $search;
        $this->date = $date;
    }

    public function query()
    {
        return Participant::query()
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%");
                });
            })
            ->when($this->date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->latest();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'No HP',
            'Alamat',
            'Tanggal Mendaftar',
        ];
    }

    public function map($participant): array
    {
        return [
            $participant->id,
            $participant->nama,
            $participant->no_hp,
            $participant->alamat,
            $participant->created_at->format('d M Y H:i:s'),
        ];
    }
}
