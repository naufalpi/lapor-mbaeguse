<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatAduan extends Model
{
    use HasFactory;

    protected $fillable = ['aduan_id', 'status', 'keterangan'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }
}
