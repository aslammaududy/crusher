<?php

namespace App\Http\Livewire\Equipments;

use App\Models\EquipmentDetail;
use Livewire\Component;
use Livewire\WithPagination;

class EquipmentDetails extends Component
{
    use WithPagination;

    public $equipmentHeaderCode;
    public $search = '';
    public $equipmentDetails = [];
    public $editedEquipmentDetails = [];

    protected $listeners = ["loadDetails"];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $details = EquipmentDetail::where(['equipment_header_code' => $this->equipmentHeaderCode])
            ->where(function ($query) {
                $query->where("material_description", "like", "%" . $this->search . "%")
                    ->orWhere("component_number", "like", "%" . $this->search . "%");
            })
            ->paginate(10, ['*'], "equipment-code-$this->equipmentHeaderCode");
        return view('equipments.equipment-details', compact("details"));
    }

    public function loadDetails($code)
    {
        $this->equipmentHeaderCode = $code;
    }

    public function fillDetails($key, $value, $isEdit = false, $index = 0)
    {
        if ($isEdit) {
            $this->editedEquipmentDetails[$index]["$key"] = $value;
        } else {
            $this->equipmentDetails["$key"] = $value;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage("equipment-code-$this->equipmentHeaderCode");
    }

    public function save($componentNumber = null, $isEdit = false, $index = 0)
    {
        if ($isEdit) {
            $details = $this->editedEquipmentDetails[$index];
        } else {
            $details = $this->equipmentDetails;
        }

        EquipmentDetail::updateOrCreate(
            [
                'component_number' => $componentNumber,
            ],
            $details,
        );

        $details = [];
        $this->dispatchBrowserEvent('details-saved');
        session()->flash("success", "Equipment detail saved successfully");
    }
}
