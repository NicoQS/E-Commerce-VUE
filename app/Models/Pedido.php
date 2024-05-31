<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_total',
        'user_id',
        'direccion_id',
        'estado_pedido_id',
        'pago_id',
    ];

    public function itemsPedidos(){
        return $this->hasMany(ItemPedido::class, 'pedido_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pago(){
        return $this->hasOne(Pago::class, 'pago_id');
    }

    public function estadoPedido(){
        return $this->belongsTo(EstadoPedido::class, 'estado_pedido_id');
    }

    public function direccion(){
        return $this->belongsTo(DireccionUsuario::class, 'direccion_id');
    }
}
