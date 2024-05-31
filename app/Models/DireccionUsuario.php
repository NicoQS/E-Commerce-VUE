<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionUsuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'numero',
        'direccion_1',
        'direccion_2',
        'codigo_postal',
        'localidad',
        'provincia'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'direccion_id');
    }
}
