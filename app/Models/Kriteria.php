<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // protected $table = 'kriteria';

    protected $fillable = [
        'name',
        'keterangan'
    ];

    public function kriteria()
    {
        # code...
        return $this->hasMany(Kriteria::class);
    }
}
