<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class StatCard extends Component
{
    public string $title;
    public int|string $count;
    public string $icon;
    public ?string $route;

    public function __construct(string $title, int|string $count, string $icon, ?string $route = null)
    {
        $this->title = $title;
        $this->count = $count;
        $this->icon = $icon;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.admin.stat-card');
    }
}
