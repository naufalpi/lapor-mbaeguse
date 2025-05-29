<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = ['aduan_id', 'nama', 'email', 'pesan'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }
}
