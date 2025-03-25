<?php

namespace App\View\Components\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ImageInput extends Component
{
    public string $name;
    public string $label;
    public ?Model $value;

    public function __construct(string $name = 'image', string $label = 'Image', ?Model $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.admin.image-input');
    }
}
