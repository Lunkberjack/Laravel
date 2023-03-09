<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'amount',
        'paid_at'
    ];
    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['paid_at'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
