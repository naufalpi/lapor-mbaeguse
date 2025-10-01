<?php

namespace App\Filament\Resources\KomentarResource\Widgets;

use Filament\Widgets\Widget;

class AduanDetailWidget extends Widget
{
    protected static string $view = 'filament.resources.komentar-resource.widgets.aduan-detail';

    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }
}
