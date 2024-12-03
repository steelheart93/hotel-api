<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['nombre', 'direccion', 'ciudad', 'nit', 'num_habitaciones'];

    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class);
    }
}
