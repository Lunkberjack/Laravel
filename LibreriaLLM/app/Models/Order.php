<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment, App\Models\User;
use App\Scopes\AvailableScope;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id'
    ];

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }
    public function getTotalAttribute() {
        return $this->products()
            // Vídeo 104: si hacemos que un producto sea unavailable al añadir su última
            // instancia a un pedido, este método de calcular total no lo tendrá visible.
            // Por tanto, pondrá que el total es 0€, pero además no habrá posibilidad de
            // recuperar el producto para un usuario que no sea administrador.
            // La forma de corregir ese error inesperado es ignorar ese global scope en
            // específico.
            ->withoutGlobalScope(AvailableScope::class)
            ->get() // obtener resultados de la base de datos
            ->pluck('total')
            ->sum();
    }
}