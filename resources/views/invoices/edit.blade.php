@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Editar Factura</h1>
  <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="client_id">Cliente</label>
      <select name="client_id" id="client_id" class="form-control" required>
        @foreach($clients as $client)
      <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
        {{ $client->name }}
      </option>
    @endforeach
      </select>
    </div>
    <div id="products">
      @foreach($invoice->items as $index => $item)
      <div class="form-group">
      <label>Producto</label>
      <select name="items[{{ $index }}][product_id]" class="form-control" required>
        @foreach($products as $product)
      <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
      {{ $product->name }}
      </option>
    @endforeach
      </select>
      <label>Cantidad</label>
      <input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item->quantity }}"
        required>
      </div>
    @endforeach
    </div>
    <button type="button" class="btn btn-secondary mt-3" onclick="addProduct()">Agregar Producto</button>
    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
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