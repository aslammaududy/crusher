<?php

namespace App\Imports;

use App\Models\EquipmentDetail;
use Maatwebsite\Excel\Concerns\ToModel;

class EquipmentDetailsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EquipmentDetail([
            //
        ]);
    }
}
