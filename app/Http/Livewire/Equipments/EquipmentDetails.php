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

    protected $listeners = [
        "loadDetails",
        "equipmentSaved" => '$refresh', // refreshing component after upload file from upload-file component
        "equipmentDetailDeleted" => '$refresh' // refreshing component after delete
    ];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $details = EquipmentDetail::where(['equipment_header_code' => $this->equipmentHeaderCode])
            ->where(function ($query) {
                $query->where("material_description", "like", "%".$this->search."%")
                    ->orWhere("component_number", "like", "%".$this->search."%");
            })
            ->paginate(10, ['*'], "equipment-code-$this->equipmentHeaderCode");
        return view('Equipments.equipment-details', compact("details"));
    }

    public function loadDetails($code)
    {
        $this->equipmentHeaderCode = $code;
    }


    public function updatingSearch()
    {
        $this->resetPage("equipment-code-$this->equipmentHeaderCode");
    }

    public function delete($id)
    {
        $detail = EquipmentDetail::find($id);
        $detail->delete();

        $this->dispatchBrowserEvent('componentDetailDeleted');
    }
}
