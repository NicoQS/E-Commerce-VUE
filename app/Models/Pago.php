<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'estado'
    ];

    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pago_id');
    }
}
