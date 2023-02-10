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
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail {
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
		'admin_since',
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

	public function isAdmin() {
	// True si el usuario contiene la propiedad admin_since
	// y además es administrador en la fecha actual.
	return $this->admin_since != null 
		&& $this->admin_since->lessThanOrEqualTo(now());
	}

	public function setPasswordAttribute($password) {
		// Ciframos la contraseña desde el setter
		$this->attributes['password'] = bcrypt($password);
	}

	public function getProfileImageAttribute() {
	return $this->image ? "images/{$this->image->path}" : 'https://www.gravatar.com/avatar/404?d=mp';
}
}