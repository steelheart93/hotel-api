<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    protected $fillable = ['tipo'];

    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class);
    }
}
