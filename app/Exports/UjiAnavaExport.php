<?php

namespace App\Exports;

use App\Models\UjiAnava;
use Maatwebsite\Excel\Concerns\FromCollection;

class UjiAnavaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return UjiAnava::all('x1', 'x2', 'x3');
    }
}
