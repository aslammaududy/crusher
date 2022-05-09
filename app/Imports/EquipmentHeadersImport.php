<?php

namespace App\Imports;

use App\Models\EquipmentHeader;
use Maatwebsite\Excel\Concerns\ToModel;

class EquipmentHeadersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EquipmentHeader([
            //
        ]);
    }
}
