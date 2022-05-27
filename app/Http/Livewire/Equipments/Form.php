<?php

namespace App\Http\Livewire\Equipments;

use App\Http\Livewire\Traits\RedirectBack;
use App\Models\EquipmentHeader;
use Livewire\Component;


class Form extends Component
{
    public $qrcode;
    public $equipmentCode;
    public $equipmentName;

    public function mount($qrcode, $equipment = null)
    {
        if ($equipment) {
            $eq = json_decode(base64_decode($equipment));
        }

        $this->qrcode = $qrcode;
        $this->equipmentCode = $eq->code ?? "";
        $this->equipmentName = $eq->name ?? "";
    }

    public function render()
    {
        return view('Equipments.form');
    }

    public function save()
    {
        EquipmentHeader::updateOrCreate(
            [
                'qr_code' => $this->qrcode,
                'code' => $this->equipmentCode,
            ],
            [
                'name' => $this->equipmentName
            ],
        );
    }

    public function redirectBack()
    {
        return redirect("equipments/$this->qrcode");
    }
}
