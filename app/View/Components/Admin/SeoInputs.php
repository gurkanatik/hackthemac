<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class SeoInputs extends Component
{
    public ?string $metaTitle;
    public ?string $metaDescription;
    public ?string $metaKeywords;

    public function __construct($meta = null)
    {
        $this->metaTitle = old('meta_title', $meta->meta_title ?? '');
        $this->metaDescription = old('meta_description', $meta->meta_description ?? '');
        $this->metaKeywords = old('meta_keywords', $meta->meta_keywords ?? '');
    }

    public function render()
    {
        return view('components.admin.seo-inputs');
    }
}
