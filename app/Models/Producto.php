<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio', 'descripcion','stock' , 'descuento' , 'imagen', 'categoria_id', 'proveedor_id'];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function imagenes(){
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'producto_id');
    }

    public function itemPedido(){
        return $this->belongsTo(ItemPedido::class, 'producto_id');
    }

}
