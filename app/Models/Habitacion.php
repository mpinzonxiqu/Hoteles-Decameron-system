<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'tipo_habitacion_id', 'acomodacion', 'cantidad'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function tipoHabitacion()
    {
        return $this->belongsTo(TipoHabitacion::class);
    }
}
