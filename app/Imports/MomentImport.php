<?php

namespace App\Imports;

use App\Models\Moment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MomentImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Moment::create([
                'x' => $row[0],
                'y' => $row[1],
            ]);
        }
    }
}
