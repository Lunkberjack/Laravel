@extends('layouts.app')

@section('content')
    <h1>Lista de usuarios</h1>

    @empty ($users)
        <div class="alert alert-warning">
            La lista de usuarios está vacía :(
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Admin desde</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{--Si no es admin (admin_since es null) pondremos un "Nunca"--}}
                            {{ optional($user->admin_since)->diffForHumans() ?? 'Nunca' }}
                        </td>
                        <td>
                            <form method="POST" class="d-inline" action="{{ route('users.admin.toggle', ['user' => $user->id]) }}">
                                @csrf
                                {{--Cambiamos el texto del botón dependiendo de si el usuario es admin
                                o no en ese preciso momento--}}
                                <button type="submit" class="btn btn-link">
                                    {{ $user->isAdmin() ? 'Eliminar' : 'Hacer' }} admin
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection