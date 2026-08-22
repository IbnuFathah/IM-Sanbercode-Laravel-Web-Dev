<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class TestExport implements FromCollection
{
    public function collection(): Collection
    {
        return collect([
            ['ID', 'Test', 'Nama'],
            [1, 'Test Pertama', 'Ibnu'],
            [2, 'Test Kedua', 'Fathah'],
        ]);
    }
}
