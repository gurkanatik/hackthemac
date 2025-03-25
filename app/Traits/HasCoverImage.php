<?php

namespace App\Traits;

trait HasCoverImage
{
    public function hasCoverImage(): bool
    {
        return !empty($this->cover_image);
    }

    public function getCoverImageUrl(): ?string
    {
        if (!$this->hasCoverImage()) {
            return null;
        }

        return asset('uploads/' . $this->cover_image);
    }

    public function getThumbnailUrl(): ?string
    {
        if (!$this->hasCoverImage()) {
            return null;
        }

        return asset($this->thumbnailPath());
    }

    protected function thumbnailPath(): string
    {
        $pathParts = explode('/', $this->cover_image);

        if (count($pathParts) < 2) {
            return 'uploads/' . $this->cover_image;
        }

        $filename = array_pop($pathParts);
        $dir = implode('/', $pathParts);

        return 'uploads/' . $dir . '/thumbs/' . $filename;
    }
}
