<?php

namespace App\Filament\Resources\AduanResource\Widgets;

use Filament\Widgets\Widget;

class AduanDetailWidget extends Widget
{
    protected static string $view = 'filament.resources.aduan-resource.widgets.aduan-detail';

    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }
}
