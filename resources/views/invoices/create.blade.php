@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Crear Factura</h1>
  <form action="{{ route('invoices.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="client_id">Cliente</label>
      <select name="client_id" id="client_id" class="form-control" required>
        <option value="">Seleccione un cliente</option>
        @foreach($clients as $client)
      <option value="{{ $client->id }}">{{ $client->name }}</option>
    @endforeach
      </select>
    </div>
    <div id="products">
      <div class="form-group">
        <label>Producto</label>
        <select name="items[0][product_id]" class="form-control" required>
          <option value="">Seleccione un producto</option>
          @foreach($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }}</option>
      @endforeach
        </select>
        <label>Cantidad</label>
        <input type="number" name="items[0][quantity]" class="form-control" required>
      </div>
    </div>
    <button type="button" class="btn btn-secondary mt-3" onclick="addProduct()">Agregar Producto</button>
    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
  </form>
</div>

<script>
  function addProduct() {
    const productsDiv = document.getElementById('products');
    const index = productsDiv.childElementCount;

    const html = `
        <div class="form-group">
            <label>Producto</label>
            <select name="items[${index}][product_id]" class="form-control" required>
                <option value="">Seleccione un producto</option>
                @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
            </select>
            <label>Cantidad</label>
            <input type="number" name="items[${index}][quantity]" class="form-control" required>
        </div>
    `;

    productsDiv.insertAdjacentHTML('beforeend', html);
  }
</script>
@endsection