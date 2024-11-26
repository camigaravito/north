@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Productos</h1>
  <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Crear Producto</a>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->code }}</td>
      <td>{{ $product->name }}</td>
      <td>${{ number_format($product->price, 2) }}</td>
      <td>
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
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