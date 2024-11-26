@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Editar Producto</h1>
  <form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="code">Código</label>
      <input type="text" name="code" id="code" class="form-control" value="{{ $product->code }}" required>
    </div>
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
      <label for="price">Precio</label>
      <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $product->price }}"
        required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
  </form>
</div>
@endsection