<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanggapan extends Model
{
    use HasFactory;

    protected $fillable = ['aduan_id', 'user_id', 'lampiran', 'isi_tanggapan'];

    protected $casts = [
        'lampiran' => 'array', // otomatis decode/encode json
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
