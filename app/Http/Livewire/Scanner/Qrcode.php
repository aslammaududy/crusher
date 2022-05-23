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
            ->distinct('qr_code')
            ->paginate(10, 'qr_code'); //fix error (empty page) when distinct and paginate is used together

        return view('Scanner.qrcode', compact('qrcodes'));
    }
}
