@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Crear Producto</h1>
  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="code">Código</label>
      <input type="text" name="code" id="code" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="price">Precio</label>
      <input type="number" step="0.01" name="price" id="price" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
  </form>
</div>
@endsection