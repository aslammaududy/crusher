<?php

namespace App\Http\Livewire\Scanner;

use App\Models\EquipmentHeader;
use Livewire\Component;
use Livewire\WithPagination;

class Qrcode extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $qrcodes = EquipmentHeader::where('qr_code', 'like', '%' . $this->search . '%')
            ->select('qr_code')
            ->distinct()
            ->paginate(10);

        return view('Scanner.qrcode', compact('qrcodes'));
    }
}
