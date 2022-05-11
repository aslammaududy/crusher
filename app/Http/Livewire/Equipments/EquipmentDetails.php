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

    protected $listeners = ["loadDetails"];
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $details = EquipmentDetail::where(['equipment_header_code' => $this->equipmentHeaderCode])
            ->where(function ($query) {
                $query->where("material_description", "like", "%" . $this->search . "%")
                    ->orWhere("component_number", "like", "%" . $this->search . "%");
            })
            ->paginate(10);
        return view('equipments.equipment-details', compact("details"));
    }

    public function loadDetails($code)
    {
        $this->equipmentHeaderCode = $code;
    }
}
