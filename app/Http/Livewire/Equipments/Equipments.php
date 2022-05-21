<?php

namespace App\Http\Livewire\Equipments;

use App\Models\EquipmentHeader;
use Livewire\Component;
use Livewire\WithPagination;

class Equipments extends Component
{
    use WithPagination;

    public $search = '';
    public $qrcode;

    protected $paginationTheme = 'bootstrap';

    public function mount($qrcode)
    {
        $this->qrcode = $qrcode;

        session(['equipments-url' => '/equipments/' . $qrcode]);
    }

    public function render()
    {
        $equipments = EquipmentHeader::where("qr_code", $this->qrcode)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('Equipments.equipments', compact("equipments"));
    }
}
