<?php
namespace App\Services;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService {
    protected $cookieName = 'cart';

    public function getFromCookie() {
        $cartId = Cookie::get($this->cookieName);
        $cart = Cart::find($cartId);

        return $cart;
    }

    public function getFromCookieOrCreate() {
        // Solo si la cookie existe y además coincide con un carrito 
        // reconocido por el sistema (id) no se crea una nueva instancia
        $cart = $this->getFromCookie();
        // Si eso es null, o tiene una id no reconocida,
        // se ejecutará la parte derecha de las ?? y se
        // creará una nueva instancia de Cart
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart) {
        // Atributo con el nombre de la cookie (manejabilidad)
        return Cookie::make($this->cookieName, $cart->id, 7 * 24 * 60);
    }

    public function countProducts() {
        $cart = $this->getFromCookie();

        if($cart != null) {
            // products es una colección, pluck() es un método de las colecciones
            return $cart->products->pluck('pivot.quantity')->sum();
        }
        return 0;
    }
}
?>