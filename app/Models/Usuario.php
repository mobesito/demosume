<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $fillable = ['apodo', 'contrasenha'];

    // Encriptamos la contrasenha antes de guardarla...
    public function setContrasenhaAttribute($value)
    {
        $this->attributes['contrasenha'] = Hash::make($value);
    }

}
