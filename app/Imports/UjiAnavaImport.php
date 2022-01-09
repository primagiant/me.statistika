<?php

namespace App\Imports;

use App\Models\UjiAnava;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UjiAnavaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            UjiAnava::create([
                'x1' => $row[0],
                'x2' => $row[1],
                'x3' => $row[2],
            ]);
        }
    }
}
