<?php

namespace App\Filament\Resources\KomentarResource\Widgets;

use Filament\Widgets\Widget;

class KomentarListWidget extends Widget
{
    protected static string $view = 'filament.resources.komentar-resource.widgets.komentar-list';

    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }
}
