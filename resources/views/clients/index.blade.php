@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Clientes</h1>
  <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Crear Cliente</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>NIT</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clients as $client)
      <tr>
      <td>{{ $client->id }}</td>
      <td>{{ $client->name }}</td>
      <td>{{ $client->nit }}</td>
      <td>{{ $client->email }}</td>
      <td>{{ $client->address }}</td>
      <td>
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection