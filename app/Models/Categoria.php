<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'categoria_padre_id'
    ];

    public function productos () {
        return $this->hasMany(Producto::class, 'categoria_id');
    }

    public function categoriaPadre () {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id');
    }

    public function categoriasHijas () {
        return $this->hasMany(Categoria::class, 'categoria_padre_id');
    }

    public function descendientes () {
        return $this->categoriasHijas()->with('descendientes');
    }
}
