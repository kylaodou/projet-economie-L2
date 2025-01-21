<?php

namespace App\Exports;

use App\Models\Mouvement;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class JounalExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Mouvement::query();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Libele',
            'Compte',
            'Montant',
            'Type',
        ];
    }

    public function map($mouvement): array
    {
        return [
            $mouvement->date,
            $mouvement->libelle,
            $mouvement->compte,
            $mouvement->montant,
            $mouvement->type,
        ];
    }
}
