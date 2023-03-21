<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'establishments_id',
        'user_created_at',
        'user_updated_at'
    ];

    public function tarifas()
    {
        return $this->hasMany(Tarifa::class, 'room_types_id');
    }

}
