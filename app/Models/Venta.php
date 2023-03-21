<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class,'habitacion_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detalles()
    {
        return $this->hasMany(VentasDetalles::class);
    }
}
