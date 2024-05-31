<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'celular',
        'email',
        'cuit',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}
