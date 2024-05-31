<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Categoria;
use App\Models\Proveedor;


class AdminProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Producto/Show', [
            'productos' => Producto::join('categorias', 'productos.categoria_id', '=', 'categorias.id')
                ->join('proveedors', 'productos.proveedor_id', '=', 'proveedors.id')
                ->select('productos.*', 'proveedors.nombre as proveedor', 'categorias.nombre as categoria')
                ->paginate(8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Producto/Partials/Agregar', [
            'categorias' => Categoria::all(),
            'proveedores' => Proveedor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        Producto::create($request->validated());
        return redirect()->route('admin.productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $producto = Producto::join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->join('proveedors', 'productos.proveedor_id', '=', 'proveedors.id')
            ->select('productos.*', 'proveedors.nombre as proveedor', 'categorias.nombre as categoria')
            ->where('productos.id', '=', $producto->id)
            ->first();
        return Inertia::render('Admin/Producto/Partials/Edit', [
            'producto' => $producto,
            'categorias' => Categoria::all(),
            'imagenes' => Producto::find($producto->id)->imagenes()->get(),
            'proveedores' => Proveedor::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());
        return redirect()->route('admin.productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        Producto::destroy($producto->id);
        Return redirect()->route('admin.productos.index');
    }
}
