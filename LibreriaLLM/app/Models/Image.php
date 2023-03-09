<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'path',
    ];
    
    public function imageable() {
        // No podemos indicar tipo de elemento porque no lo sabemos:
        // la función morphTo() se encarga de ello automáticamente.
        return $this->morphTo();
    }
}