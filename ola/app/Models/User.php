<?php
// Sacado de la carpeta models,
// namespace cambiado (antes App/Models).
// Cambiamos también el archivo config, auth.php.
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Order, App\Models\Payment, App\Models\Image;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * The attributes that should be converted to dates.
	 * @var [type]
	 */
	protected $dates = [
		'admin-since',
	];

	public function orders() {
		return $this->hasMany(Order::class, 'customer_id');
	}

	public function payments() {
		return $this->hasManyThrough(Payment::class, Order::class, 'customer_id');
	}

	public function image() {
		return $this->morphOne(Image::class, 'imageable');
	}
}