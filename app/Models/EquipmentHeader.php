<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'code',
        'name'
    ];

    public function details()
    {
        return $this->hasMany(
            EquipmentDetail::class,
            "equipment_header_code",
            "code"
        );
    }

    public function images()
    {
        return $this->hasMany(
            EquipmentImage::class,
            "equipment_header_code",
            "code"
        );
    }
}
