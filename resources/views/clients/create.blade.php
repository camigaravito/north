@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Crear Cliente</h1>
  <form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="nit">NIT</label>
      <input type="text" name="nit" id="nit" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="phone">Teléfono</label>
      <input type="text" name="phone" id="phone" class="form-control">
    </div>
    <div class="form-group">
      <label for="address">Dirección</label>
      <input type="text" name="address" id="address" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
  </form>
</div>
@endsection