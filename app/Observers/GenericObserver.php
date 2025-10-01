<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class GenericObserver
{
    public function created(Model $model): void
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($model)
            ->event('created')
            ->log(class_basename($model) . ' berhasil dibuat');
    }

    public function updated(Model $model): void
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($model)
            ->event('updated')
            ->log(class_basename($model) . ' berhasil diperbarui');
    }

    public function deleted(Model $model): void
    {
        activity()
            ->causedBy(Auth::user())
            ->performedOn($model)
            ->event('deleted')
            ->log(class_basename($model) . ' berhasil dihapus');
    }
}
