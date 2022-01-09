<?php

namespace App\Imports;

use App\Models\UjiAnava;
use Maatwebsite\Excel\Concerns\ToModel;

class UjiAnavaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new UjiAnava([
            'x1' => $row[0],
            'x2' => $row[1],
            'x3' => $row[2],
        ]);
    }
}
