<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Opd extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function aduans()
    {
        return $this->hasMany(Aduan::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
