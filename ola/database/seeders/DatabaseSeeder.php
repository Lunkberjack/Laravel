<?php

namespace Database\Seeders;

use App\Models\Product, App\Models\User, App\Models\Order, App\Models\Payment, App\Models\Image, App\Models\Cart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(20)
            ->create()
            // Función anónima que recibe como parámetro a cada User
            ->each(function ($user) {
                // Creamos y asignamos una imagen para cada User
                $image = Image::factory()->user()->make();
                $user->image()->save($image);
            });

        $orders = Order::factory(10)
            ->make()
            ->each(function($order) use ($users) {
                $order->customer_id = $users->random()->id;
                $order->save();

                $payment = Payment::factory()->make();

                // $payment->order_id = $order_id;
                // $payment->save();

                $order->payment()->save($payment);
            });

        $carts = Cart::factory(20)->create();

        $products = Product::factory(50)
            ->create()
            ->each(function ($product) use ($orders, $carts) {
                $order = $orders->random();
                $order->products()->attach([
                    $product->id => ['quantity' => mt_rand(1,3)]
                ]);

                $cart = $carts->random();

                $cart->products()->attach([
                    $product->id => ['quantity' => mt_rand(1,3)]
                ]);

                $images = Image::factory(mt_rand(2,4))->make();
                $product->images()->saveMany($images);
            });
    }
}
