<?php

namespace App\Http\Livewire\Equipments;

use App\Models\EquipmentDetail;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $componentNumber;
    public $file;
    public $uploadProgress = 0;
    public $isUploading = false;

    public function mount($componentNumber)
    {
        $this->componentNumber = $componentNumber;
    }

    public function render()
    {
        return view('Equipments.upload-file');
    }

    public function updatedImages()
    {
        $this->validate([
            'file' => 'mimes:png,jpg,pdf|max:2048',
        ]);

        $this->uploadProgress = 0;
        $this->isUploading = false;
    }

    public function upload()
    {
        $detail = EquipmentDetail::where('component_number', $this->componentNumber)->first();

        $filePath = 'file/equipments';
        $fileName = "file_" . $this->componentNumber . "." . $this->file->getClientOriginalExtension();

        $detail->file = $filePath . "/" . $fileName;

        $this->file->storeAs('public/' . $filePath, $fileName);

        $detail->save();

        $this->dispatchBrowserEvent("uploadSucceded");
    }
}
