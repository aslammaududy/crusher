<?php

namespace App\Http\Livewire\Equipments;

use App\Models\EquipmentHeader;
use Livewire\Component;
use Livewire\WithPagination;

class Equipments extends Component
{
    use WithPagination;

    public $search;
    public $qrcode;

    protected $paginationTheme = 'bootstrap';

    public function mount($qrcode)
    {
        $this->qrcode = $qrcode;
    }

    public function render()
    {
        $equipments = EquipmentHeader::where("qr_code", $this->qrcode)
            ->paginate(10);

        return view('equipments.equipments', compact("equipments"));
    }
}
