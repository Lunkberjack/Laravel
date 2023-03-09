<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Se asegura de que haya una sesión de usuario
    // válido y autenticado (que no verificado)
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Request $request)
    {
        return view('profiles.edit')->with([
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $user = $request->user();

            // Vídeo 100 (solución de bug)
            // El setter del que hablamos en vídeos anteriores acabó dando un error, ya que la
            // contraseña era cifrada incluso cuando el valor pasado era null (el usuario
            // quedaba por tanto sin acceso).
            //
            // Lo que hemos hecho ha sido excluir los valores nulos de la validación.
            // Ahora no nos va a pasar un valor nulo como componente de la request de
            // actualización y bcrypt no va a encriptarlo. Simplemente se ignora.
            // user->fill($request->validated());
            $user->fill(array_filter($request->validated()));
            // Tenemos que verificar que el correo electrónico ha cambiado
            // (si no, haremos modificaciones para nada)
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }

            // Crear un setter ¡¡en el modelo User!! que cifre la contraseña (Laravel llama al setter automáticamente)
        
            // Guardar el usuario
            $user->save();

            // Si el request de editar nos pasa una imagen nueva:
            if($request->hasFile('image')) {
                // Si el usuario ya tiene una imagen antigua (borrar)
                if($user->image != null) {
                    // Busca el disco donde sabemos que está la imagen local
                    Storage::disk('images')->delete($user->image->path);
                    // Borramos de la base de datos
                    $user->image->delete();
                }

                $user->image()->create([
                    'path' => $request->image->store('users', 'images'),
                ]);
            }

            return redirect()
                ->route('profile.edit')
                ->withSuccess('Profile edited');
        }, 5); // cantidad de veces que se puede reintentar la operación si hay bloqueo
    }
}