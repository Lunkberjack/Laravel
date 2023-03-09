<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('users.index')->with([
            'users' => User::all(),
        ]);
    }

/**
 * Si el usuario era administrador, se le quita ese privilegio.
 * Si no lo era, lo hacemos admin cogiendo como fecha el mismo
 * momento en que se pulsa el botón.
 * @param  User   $user [description]
 * @return [type]       [description]
 */
    public function toggleAdmin(User $user) {
        if ($user->isAdmin()) {
            $user->admin_since = null;
        } else {
            $user->admin_since = now();
        }

        $user->save();

        return redirect()
            ->route('users.index')
            // Avisamos del cambio de estado del usuario.
            ->withSuccess("Admin status for user {$user->id} was toggled.");
    }
}