<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad'
    ];

    public function producto(){
        return $this->hasOne(Producto::class, 'producto_id');
    }

    public function pedido(){
        return $this->hasOne(Pedido::class, 'pedido_id');
    }
}
