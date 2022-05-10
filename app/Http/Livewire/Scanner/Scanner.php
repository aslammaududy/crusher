<?php

namespace App\Http\Livewire\Scanner;

use Livewire\Component;

class Scanner extends Component
{
    public $qrcode;
    public function render()
    {
        return view('scanner.scanner');
    }

    public function updatedQrcode()
    {
        return redirect("equipments/" . $this->qrcode);
    }
}
