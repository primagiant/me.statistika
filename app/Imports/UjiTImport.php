<?php

namespace App\Imports;

use App\Models\UjiT;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UjiTImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            UjiT::create([
                'x1' => $row[0],
                'x2' => $row[1],
            ]);
        }
    }
}
