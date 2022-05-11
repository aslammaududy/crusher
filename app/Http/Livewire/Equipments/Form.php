<?php

namespace App\Http\Livewire\Equipments;

use App\Http\Livewire\Traits\RedirectBack;
use App\Models\EquipmentHeader;
use Livewire\Component;
use Livewire\WithFileUploads;


class Form extends Component
{
    use WithFileUploads;

    public $qrcode;
    public $equipmentCode;
    public $equipmentName;
    public $componentCode;
    public $materialDescription;
    public $componentQuantity;
    public $unit;
    public $storage;
    public $images = [];

    public $uploadProgress = 0;
    public $isUploading = false;

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
        return view('equipments.form');
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

        $this->dispatchBrowserEvent("equipmentSaved");
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048',
        ]);

        if (count($this->images) > 5) {
            $this->addError('images', 'The uploaded images can not contain more than 5 items.');
            $this->images = [];
            $this->uploadProgress = 0;
            $this->isUploading = false;
        }
    }

    public function redirectBack()
    {
        return redirect("equipments/$this->qrcode");
    }
}
