<?php

namespace App\Http\Livewire\Scanner;

use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $qrcode;
    public $equipmentCode;
    public $componentCode;
    public $materialDescription;
    public $componentQuantity;
    public $unit;
    public $storage;
    public $images = [];

    public $uploadProgress = 0;
    public $isUploading = false;

    public function render()
    {
        return view('scanner.form');
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048',
        ]);

        if (count($this->images) > 5) {
            $this->addError('images', 'The uploaded images can not contain more than 5 items.');
            $this->images = [];
            $this->uploadProgress = 0;
            $this->isUploading = false;
        }
    }
}
