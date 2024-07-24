<?php

namespace App\View\Components;

use App\Filament\Pages\poster;
use Filament\Forms\Components\Component;
use App\View\Components\Image;


class PictureComponent extends Component
{
    public $imageUrl;
    public $imageAlt;

    public function mount()
    {
        $this->imageUrl = asset('images/poster.jpg');
        $this->imageAlt = 'poster';
    }

    public function Components()
    {
        return poster::make(
            'filament.components.picture-component',
            [
                'imageUrl' => $this->imageUrl,
                'imageAlt' => $this->imageAlt,
            ]
        );
    }
}
