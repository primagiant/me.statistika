<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Data::create([
                'nama' => "-",
                'nilai_1' => $row[0],
            ]);
        }
    }
}
