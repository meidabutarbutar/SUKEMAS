<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Radio;

class CustomRadio extends Radio
{
    protected string $view = 'components.forms.custom-radio';

    public function getFieldWrapperView(): string
    {
        return 'forms.field-wrapper.custom-label';
    }
}
