<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileViewer extends Component
{
    public $componentNumber;
    public $src;
    public $ext = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src, $componentNumber)
    {
        $this->src = $src;
        $this->componentNumber = $componentNumber;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $e = explode(".", $this->src);

        if (array_key_exists(1, $e)) {
            $this->ext = strtolower($e[1]);
        }

        return view('components.file-viewer');
    }
}
