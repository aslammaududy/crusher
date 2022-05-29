<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_header_code',
        'component_number',
        'material_description',
        'component_quantity',
        'unit',
        'storage',
        'file'
    ];

    public function file()
    {
        return $this->hasMany(
            EquipmentImage::class,
            "component_number",
            "component_number"
        );
    }
}
