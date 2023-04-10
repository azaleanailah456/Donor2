<?php

namespace App\Exports;

use App\Models\Darah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DarahExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Darah::with('response')->orderBy('created_at', 'DESC',)->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Umur',
            'Berat Badan',
            'Telp',
            'Date',
            'Status Response',
            'Pesan Response',
        ];
    }

    public function map($item): array
    {
        return [
            $item->no,
            $item->name,
            $item->umur,
            $item->bb,
            $item->no_telp,
            \Carbon\Carbon::parse($item->created_at)->format('j F, Y'),
            $item->response ? $item->response['status'] : '-',
            $item->response ? $item->response['pesan'] : '-',
        ];
    }
}
