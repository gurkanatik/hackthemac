<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Editor extends Component
{
    public string $name;
    public string $label;
    public ?string $value;
    public string $height;

    public function __construct(
        string $name = 'description',
        string $label = 'Description',
        ?string $value = null,
        string $height = '500px'
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->height = $height;
    }

    public function render()
    {
        return view('components.admin.editor');
    }
}
