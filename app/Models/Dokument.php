<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokument extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'kriterias_id',
        'subs_id'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriterias_id', 'id');
    }

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'subs_id', 'id');
    }
}
