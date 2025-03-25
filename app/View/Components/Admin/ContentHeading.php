<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class ContentHeading extends Component
{
    public $title;
    public $buttons;

    public function __construct($title, $buttons = [])
    {
        $this->title = $title;
        $this->buttons = $buttons;
    }

    public function render()
    {
        return view('components.admin.content-heading');
    }
}
