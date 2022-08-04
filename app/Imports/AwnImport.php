<?php

namespace App\Imports;

use App\Models\data_awn;
use Maatwebsite\Excel\Concerns\ToModel;

class AwnImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new data_awn($row);
    }
}
