@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Editar Cliente</h1>
  <form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
    </div>
    <div class="form-group">
      <label for="nit">NIT</label>
      <input type="text" name="nit" id="nit" class="form-control" value="{{ $client->nit }}" required>
    </div>
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}">
    </div>
    <div class="form-group">
      <label for="phone">Teléfono</label>
      <input type="text" name="phone" id="phone" class="form-control" value="{{ $client->phone }}">
    </div>
    <div class="form-group">
      <label for="address">Dirección</label>
      <input type="text" name="address" id="address" class="form-control" value="{{ $client->address }}">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
  </form>
</div>
@endsection