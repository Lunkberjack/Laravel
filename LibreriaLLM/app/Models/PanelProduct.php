<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelProduct extends Product
{
    // Tiene todas las propiedades y atributos de Producto,
    // pero elimina el uso de scopes (que no permite que se
    // muestren los productos con status no disponible)
    
    protected static function booted() {
        //
    }

    public function getForeignKey() {
        // Para solucionar problemas con la herencia del PanelProduct
        // creamos una instancia de la clase padre Product.
        $parent = get_parent_class($this);
        // Creamos un objeto padre y devolvemos la clase.
        return (new $parent)->getForeignKey();
    }

    public function getMorphClass() {
        $parent = get_parent_class($this);
        return (new $parent)->getMorphClass();
    }
}
