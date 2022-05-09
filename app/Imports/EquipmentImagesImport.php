<?php

namespace App\Imports;

use App\Models\EquipmentImage;
use Maatwebsite\Excel\Concerns\ToModel;

class EquipmentImagesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EquipmentImage([
            //
        ]);
    }
}
