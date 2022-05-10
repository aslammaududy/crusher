<?php

namespace App\Http\Livewire\Equipments;

use Livewire\Component;

class EquipmentDetails extends Component
{
    protected $listeners = ["loadDetails"];

    public function render()
    {
        return view('equipments.equipment-details');
    }

    public function loadDetails($code)
    {
        dd($code);
    }
}
