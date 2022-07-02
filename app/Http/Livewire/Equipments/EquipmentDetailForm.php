<?php

namespace App\Http\Livewire\Equipments;

use App\Models\EquipmentDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EquipmentDetailForm extends Component
{
    use WithFileUploads;

    public $equipmentHeaderCode;
    public $componentNumber;
    public $materialDescription;
    public $componentQuantity;
    public $unit;
    public $storage;
    public $file;

    public $isUpdate = false;
    public $uploadProgress = 0;
    public $isUploading = false;

    protected $listeners = ['loadHeaderCode', 'editing'];

    public function render()
    {
        return view('Equipments.equipment-detail-form');
    }

    public function loadHeaderCode($code)
    {
        $this->equipmentHeaderCode = $code;
    }

    public function editing($number)
    {
        $this->componentNumber = $number;
        $this->isUpdate = true;

        $detail = EquipmentDetail::where("component_number", $number)->first();

        $this->materialDescription = $detail->material_description;
        $this->componentQuantity = $detail->component_quantity;
        $this->unit = $detail->unit;
        $this->storage = $detail->storage;
    }

    public function updatedImages()
    {
        $this->validate([
            'file' => 'mimes:png,jpg,pdf|max:2048',
        ]);

        $this->uploadProgress = 0;
        $this->isUploading = false;
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $detail = EquipmentDetail::updateOrCreate(
                [
                    "equipment_header_code" => $this->equipmentHeaderCode,
                    "component_number" => $this->componentNumber,
                ],
                [
                    "material_description" => $this->materialDescription,
                    "component_quantity" => $this->componentQuantity,
                    "unit" => $this->unit,
                    "storage" => $this->storage,
                    "file" => "",
                ]
            );

            if (!is_null($this->file)) {
                $filePath = 'file/equipments';
                $fileName = "file_" . $this->componentNumber . "." . $this->file->getClientOriginalExtension();

                $detail->file = $filePath . "/" . $fileName;

                $this->file->storeAs('public/' . $filePath, $fileName);

                $detail->save();
            }

            $this->dispatchBrowserEvent("equipmentSaved");

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
            $this->dispatchBrowserEvent(
                "equipmentNotSaved",
                [
                    "message" => $th->getMessage(),
                    "line" => $th->getLine(),
                    "file" => $th->getFile()
                ]
            );
        }
    }
}
