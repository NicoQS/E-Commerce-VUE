<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $categoriasPrincipales = [
        'Electrónica',
        'Moda y Accesorios',
        'Hogar y Jardín',
        'Salud y Belleza',
        'Deportes y Aire Libre',
        'Electrodomésticos y Linea Blanca',
        'Juguetes y Entretenimiento',
        'Automotriz',
        'Libros, Música y Películas',
        'Mascotas',
        'Alimentos y Bebidas',
        'Oficina y Papelería',
        'Electrónicos y Computadoras',
        'Arte y Artesanía',
    ];
/*

Un e-commerce completo, similar a Mercado Libre, generalmente se organiza en diversas categorías
principales para facilitar la búsqueda y compra de productos.
Aquí tienes ejemplos de algunas categorías principales que podrían estar presentes en un e-commerce integral:

1. **Electrónica:**
   - Teléfonos móviles.
   - Computadoras y laptops.
   - Cámaras y accesorios.
   - Dispositivos electrónicos personales.

2. **Moda y Accesorios:**
   - Ropa para hombres, mujeres y niños.
   - Calzado.
   - Joyería y accesorios.

3. **Hogar y Jardín:**
   - Muebles.
   - Electrodomésticos.
   - Decoración para el hogar.
   - Jardinería y herramientas.

4. **Salud y Belleza:**
   - Productos de cuidado personal.
   - Maquillaje y cosméticos.
   - Suplementos nutricionales.

5. **Deportes y Aire Libre:**
   - Ropa deportiva.
   - Equipos de ejercicio.
   - Artículos para actividades al aire libre.

6. **Electrodomésticos y Linea Blanca:**
   - Lavadoras y secadoras.
   - Refrigeradores.
   - Hornos y microondas.

7. **Juguetes y Entretenimiento:**
   - Juguetes para niños.
   - Juegos de mesa.
   - Artículos de entretenimiento.

8. **Automotriz:**
   - Repuestos y accesorios para autos y motocicletas.
   - Herramientas automotrices.
   - Electrónica para vehículos.

9. **Libros, Música y Películas:**
   - Libros impresos y electrónicos.
   - CD y vinilos.
   - Películas en DVD y Blu-ray.

10. **Mascotas:**
    - Alimentos para mascotas.
    - Juguetes y accesorios para mascotas.
    - Productos de cuidado para mascotas.

11. **Alimentos y Bebidas:**
    - Alimentos no perecederos.
    - Bebidas alcohólicas y no alcohólicas.
    - Productos gourmet.

12. **Oficina y Papelería:**
    - Suministros de oficina.
    - Equipos de oficina.
    - Material de papelería.

13. **Electrónicos y Computadoras:**
    - Componentes y accesorios de computadoras.
    - Electrónicos para el hogar.
    - Software y aplicaciones.

14. **Arte y Artesanía:**
    - Materiales de arte.
    - Obras de arte.
    - Kits de manualidades.
 */
    public function definition(): array
    {
        $categoria = Categoria::all();
        /* $categoria_padre_id = $categoria->isEmpty() ? 1 : $categoria->random()->id; */

        return [
            'nombre' => $this->faker->unique->randomElement($this->categoriasPrincipales),
            'categoria_padre_id' => NULL,
        ];
    }

    /* public function configure(): self
    {
        return $this->afterCreating(function (Categoria $categoria) {
            // Después de crear la categoría, actualiza categoria_padre_id con un id aleatorio de las categorías existentes
            $categoriaId = Categoria::where('id', '<>', $categoria->id)->pluck('id')->toArray();
            $categoria->update(['categoria_padre_id' => $this->faker->randomElement($categoriaId)]);
        });
    } */

}
