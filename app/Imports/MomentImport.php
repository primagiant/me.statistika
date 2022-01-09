<?php

namespace App\Imports;

use App\Models\Moment;
use Maatwebsite\Excel\Concerns\ToModel;

class MomentImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Moment([
            'x' => $row[0],
            'y' => $row[1],
        ]);
    }
}
