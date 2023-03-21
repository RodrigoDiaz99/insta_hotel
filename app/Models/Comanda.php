<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comanda extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function dispositivo()
    {
        return $this->belongsTo(TipoDispositivo::class, 'tipo_dispositivo_id');
    }
}
