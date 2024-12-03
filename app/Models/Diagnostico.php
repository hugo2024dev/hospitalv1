<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['codigo', 'nombre'];

    public function citas()
    {
        return $this->belongsToMany(Cita::class)->withPivot(['tipo']);
    }
}
