<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Image;
use App\Scopes\AvailableScope;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $with = [
        'images',
    ];
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AvailableScope);
    }

    public function carts()
    {
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function orders()
    {
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function images() {
        // Importante indicar el nombre de la relación polimórfica
        return $this->morphMany(Image::class, 'imageable');
    }

//  Para vídeo 65: Scopes
    public function scopeAvailable($query) {
        $query->where('status', 'available');
    }

    public function getTotalAttribute(){
        return $this->pivot->quantity * $this->price;
    }
}